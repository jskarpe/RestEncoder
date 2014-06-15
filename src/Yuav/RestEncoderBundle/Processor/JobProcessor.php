<?php
namespace Yuav\RestEncoderBundle\Processor;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\MediaFile;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Processor\Job\OutputFilter;
use Yuav\RestEncoderBundle\Processor\Input\Downloader;
use Doctrine\Common\Persistence\ObjectManager;
use Monolog;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Psr\Log\LoggerInterface;

class JobProcessor
{
    private $logger;
    private $om;
    private $outputQueueProducer;
    private $mediaFileProcessor;
    private $tempFiles = array();
    private $outputFilter;
    private $downloader;
      
    public function __construct(ObjectManager $om, Producer $outputQueueProducer, LoggerInterface $logger = null)
    {
        $this->om = $om;
        $this->outputQueueProducer = $outputQueueProducer;
        $this->logger = $logger;
    }
    
    public function __destruct()
    {
        foreach ($this->tempFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
    
    public function process(Job $job)
    {
        // Download a local copy of input
        if ($this->logger) {
            $this->logger->debug('Downloading file '.$job->getInput());
        }
        $this->setJobState($job, 'downloading');
        $downloader = $this->getDownloader();
        $inputFile = $downloader->downloadFileAdvanced($job->getInput());
        $this->tempFiles[] = $inputFile;
        
        // Analyze file
        $mediaProcessor = $this->getMediaFileProcessor();
        $inputMediaFile = $mediaProcessor->process($inputFile);
        $job->setInputMediaFile($inputMediaFile);
        
        // Queue valid outputs for encoding
        $outputFilter = $this->getOutputFilter();
        $outputs = $outputFilter->findValidOutputs($inputMediaFile, $job);
        foreach ($outputs as $output) {
     
            // Publish job to RabbitMQ
            $msg = array('job_id' => $job->getId(), 'output_id' => $output->getId());
            $this->outputQueueProducer->publish(json_encode($msg));
        }
        
        // Queue thumbnails generation
        
        
        // Cleanup
        if (file_exists($inputFile)) {
            unlink($inputFile);
        }
        
        return $job;
    }

    private function setJobState($job, $state)
    {
        $job->setState($state);
        $this->om->persist($job);
        $this->om->flush();
    }
    
    public function setMediaFileProcessor(MediaFileProcessor $MediaFileProcessor)
    {
        $this->mediaFileProcessor = $mediaFileProcessor;
        return $this;
    }
    
    public function getMediaFileProcessor()
    {
        if (null === $this->mediaFileProcessor) {
            $this->mediaFileProcessor = new MediaFileProcessor();
        }
        return $this->mediaFileProcessor;
    }
    
    public function setOutputFilter(OutputFilter $outputFilter)
    {
        $this->outputFilter = $outputFilter;
        return $this;
    }
    
    public function getOutputFilter()
    {
        if (null === $this->outputFilter) {
            $this->outputFilter = new OutputFilter();
        }
        return $this->outputFilter;
    }

    /**
     * 
     * @return Downloader
     */
    public function getDownloader()
    {
        if (null === $this->downloader) {
            $this->downloader = new Downloader();
        }
        return $this->downloader;
    }

    public function setDownloader(Downloader $downloader)
    {
        $this->downloader = $downloader;
        return $this;
    }
	
    
}