<?php
namespace Yuav\RestEncoderBundle\Processor;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Processor\Input\Downloader;
use FFMpeg\FFMpeg;
use Yuav\RestEncoderBundle\Processor\Output\Translator;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OutputProcessor
{

    private $downloader;
    private $ffmpeg;
    private $logger;
    private $om;
    private $currentJob;

    public function __construct(ObjectManager $om, FFMpeg $ffmpeg, LoggerInterface $logger = null)
    {
        $this->om = $om;
        $this->ffmpeg = $ffmpeg;
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

    public function process(Output $output)
    {
        $job = $output->getJob();
        $this->currentJob = $job;
        $downloader = $this->getDownloader();
        $inputFile = $downloader->downloadFileAdvanced($job->getInput());
        $this->tempFiles[] = $inputFile;
        $video = $this->ffmpeg->open($inputFile);
        
        $translator = new Translator();
        
        $translator->addFFMpegFilters($video, $job->getInputMediaFile(), $output);
        
        $filename = $output->getFilename();
        if (null === $filename) {
            $filename = basename($job->getInput());
        }
        
        $outputPathFile = tempnam(sys_get_temp_dir(), 'RestEncoder') . $filename;
        $format = $translator->getFFMpegFormatFromOutput($output);
        
        $format->on('progress', array($this, 'updateProgress'));
        
        $video->save($format, $outputPathFile);
        $this->tempfiles[] = $outputPathFile;
        
//         $this->uploadOutputFile($output, $outputPathFile);
        
        return $output;
    }

    public function updateProgress($video, $format, $percentage)
    {
        if ($this->currentJob instanceof Job) {
            $this->currentJob->setCurrentEventProgress("$percentage%");
        }
    }
    
    public function upload($outputFile)
    {}

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