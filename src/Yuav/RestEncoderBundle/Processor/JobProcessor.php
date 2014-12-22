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
use Doctrine\Common\Collections\ArrayCollection;
use Yuav\RestEncoderBundle\Processor\Job\OutputTranslator;

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
            $this->logger->debug('Downloading file ' . $job->getInput());
        }
        $job->setProgress('0%');
        $this->setJobState($job, 'downloading');
        $downloader = $this->getDownloader();
        $inputFile = $downloader->downloadFileAdvanced($job->getInput());
        $this->tempFiles[] = $inputFile;
        if ($this->logger) {
            $this->logger->debug('Successfully downloaded ' . $inputFile . ' to ' . $inputFile . ' (' . filesize($inputFile) . ' bytes)');
        }
        
        // Analyze file
        $job->setProgress('10%');
        $this->setJobState($job, 'analyzing input');
        $mediaProcessor = $this->getMediaFileProcessor();
        $inputMediaFile = $mediaProcessor->process($inputFile);
        $inputMediaFile->setUrl($job->getInput());
        $inputMediaFile->setTest($job->getTest());
        $job->setInputMediaFile($inputMediaFile);
        
        // Queue valid outputs for encoding
        $job->setProgress('20%');
        $this->setJobState($job, 'queuing output');
        $outputFilter = $this->getOutputFilter();
        $outputs = $outputFilter->findValidOutputs($inputMediaFile, $job);
        if (empty($outputs)) {
            if ($this->logger) {
                $this->logger->error('No valid outputs found in job ' . $job->getId());
            }
        }
        
        $translator = new OutputTranslator();
        $job->setOutputs(new ArrayCollection());
        foreach ($outputs as $output) {
            $job->addOutput($output);
            $outputMediaFile = $translator->outputToMediaFile($output, $job->getInputMediaFile());
            $outputMediaFile->setJob($job);
            
            // Publish job to RabbitMQ
            $msg = array(
                'job_id' => $job->getId(),
                'output_id' => $output->getId()
            );
            $jsonmsg = json_encode($msg);
            $this->outputQueueProducer->publish($jsonmsg);
            if ($this->logger) {
                $this->logger->debug("Added output $jsonmsg to queue (" . $output->getFormat() . ')');
            }
        }
        
        // Queue thumbnails generation
        
        // Cleanup
        $downloader->rmTmpFile($job->getInput());
        
        $job->setProgress('30%');
        $this->setJobState($job, 'encoding');
        if ($this->logger) {
            $this->logger->debug('Analysis of ' . $inputFile . ' complete.');
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