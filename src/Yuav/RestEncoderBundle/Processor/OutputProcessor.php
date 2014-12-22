<?php
namespace Yuav\RestEncoderBundle\Processor;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Processor\Input\Downloader;
use FFMpeg\FFMpeg;
use Yuav\RestEncoderBundle\Processor\Output\Translator;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gaufrette;

class OutputProcessor
{

    private $downloader;

    private $ffmpeg;

    private $logger;

    private $om;

    private $currentOutput;

    /**
     *
     * @var \Gaufrette\Filesystem
     */
    private $fs;

    private $tempFiles;

    public function __construct(ObjectManager $om, FFMpeg $ffmpeg, \Knp\Bundle\GaufretteBundle\FilesystemMap $fsMap, LoggerInterface $logger = null)
    {
        $this->om = $om;
        $this->ffmpeg = $ffmpeg;
        $this->fs = $fsMap->get('outputs');
        $this->logger = $logger;
    }

    public function __destruct()
    {
        if (is_array($this->tempFiles) && ! empty($this->tempFiles)) {
            foreach ($this->tempFiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }

    public function process(Output $output)
    {
        $job = $output->getJob();
        $this->currentOutput = $output;
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
        
        $format->on('progress', array(
            $this,
            'updateProgress'
        ));
        
        $video->save($format, $outputPathFile);
        $this->tempfiles[] = $outputPathFile;
        
        $key = basename($outputPathFile);
        
        $this->upload($key, file_get_contents($outputPathFile));
        
        $output->setUrl('file/' . $key);
        $this->om->persist($output);
        $this->om->flush();
        return $output;
    }

    public function updateProgress($video, $format, $percentage)
    {
        if ($this->currentOutput instanceof Output) {
            $this->currentOutput->setCurrentEventProgress("$percentage%");
            $this->om->persist($this->currentOutput);
            $this->om->flush();
        }
    }

    public function upload($key, $contents)
    {
        $this->fs->write($key, $contents);
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