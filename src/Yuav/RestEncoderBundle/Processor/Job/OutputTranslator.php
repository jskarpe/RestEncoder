<?php
namespace Yuav\RestEncoderBundle\Processor\Job;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\MediaFile;
use Yuav\RestEncoderBundle\Entity\Output;

class OutputTranslator
{

    /**
     * Generate output mediafile object
     *
     * @param Output $output            
     * @param MediaFile $inputMediaFile            
     * @return MediaFile $outputMediaFile
     */
    public function outputToMediaFile(Output $output, MediaFile $inputMediaFile)
    {
        $outputMediaFile = new MediaFile();
        $outputMediaFile->setAudioBitrateInKbps($output->getAudioBitrate());
        $outputMediaFile->setAudioCodec($output->getAudioCodec());
        $outputMediaFile->setAudioSampleRate($output->getAudioSampleRate());
        $outputMediaFile->setChannels($output->getAudioChannels());
        $durationInMs = $this->findTargetDuration($inputMediaFile->getDurationInMs(), $output);
        $outputMediaFile->setDurationInMs($durationInMs);
        $outputMediaFile->setFormat($output->getFormat());
        $outputMediaFile->setFrameRate($output->getFrameRate());
        $outputMediaFile->setHeight($output->getHeight());
        $outputMediaFile->setUrl($output->getUrl());
        $outputMediaFile->setVideoBitrateInKbps($output->getVideoBitrate());
        $outputMediaFile->setVideoCodec($output->getVideoCodec());
        $outputMediaFile->setWidth($output->getWidth());
        return $outputMediaFile;
    }

    public function findTargetDuration($originalDurationInMs, Output $output)
    {
        if ($originalDurationInMs < $output->getMinDuration() * 1000) {
            throw new \InvalidArgumentException(__METHOD__ . ' Original duration: ' . $originalDurationInMs / 1000 . 's not larger than minimum duration: ' . $output->getMinDuration() . 's');
        }
        
        $duration = $originalDurationInMs;
        if ($output->getMaxDuration() < $originalDurationInMs) {
            $duration = $output->getMaxDuration();
        }
        
        return $duration;
    }
}