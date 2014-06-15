<?php
namespace Yuav\RestEncoderBundle\Processor;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Processor\Input\Downloader;
use FFMpeg\FFMpeg;
use Yuav\RestEncoderBundle\Processor\Output\Translator;

class OutputProcessor
{

    private $downloader;

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
        $downloader = $this->getDownloader();
        $inputFile = $downloader->downloadFileAdvanced($job->getInput());
        $this->tempFiles[] = $inputFile;
        
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($inputFile);
        
        $translator = new Translator();
        
        $translator->addFFMpegFilters($video, $job->getInputMediaFile(), $output);
        
        $filename = $output->getFilename();
        if (null === $filename) {
            $filename = basename($job->getInput());
        }
        
        $outputPathFile = tempnam(sys_get_temp_dir(), 'RestEncoder') . $filename;
        $format = $translator->getFFMpegFormatFromOutput($output);
        $video->save($format, $outputPathFile);
        $this->tempfiles[] = $outputPathFile;
        
//         $this->uploadOutputFile($output, $outputPathFile);
        
        return $output;
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