<?php
namespace Yuav\RestEncoderBundle\Processor\Job;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\MediaFile;
use Yuav\RestEncoderBundle\Entity\Output;

class OutputFilter
{

    public function findValidOutputs(MediaFile $inputMediaFile, Job $job)
    {
        $outputs = array();
        foreach ($job->getOutputs() as $output) {
            if (!$this->hasValidDimensions($inputMediaFile, $output)) {
                continue;
            }
            if (!$this->hasValidDuration($inputMediaFile, $output)) {
                continue;
            }
            $outputs[] = $output;
        }
        return $outputs;
    }
    
    public function hasValidDimensions(MediaFile $inputMediaFile, Output $output)
    {
        $minDimensions = $output->getMinSize();
        if (! empty($minDimensions)) {
            list ($minWidth, $minHeight) = explode('x', $minDimensions);
            if ($inputMediaFile->getWidth() < $minWidth || $inputMediaFile->getHeight() < $minHeight) {
                return false;
            }
        }
    
        $maxDimensions = $output->getMaxSize();
        if (! empty($maxDimensions)) {
            list ($maxWidth, $maxHeight) = explode('x', $maxDimensions);
            if ($inputMediaFile->getWidth() > $maxWidth || $inputMediaFile->getHeight() > $maxHeight) {
                return false;
            }
        }
    
        return true;
    }
    
    public function hasValidDuration(MediaFile $inputMediaFile, Output $output)
    {
        // Output duration is in seconds
        if ($inputMediaFile->getDurationInMs() * 1000 < $output->getMinDuration()) {
            return false;
        }
    
        if ($inputMediaFile->getDurationInMs() * 1000 > $output->getMaxDuration()) {
            return false;
        }
    
        return true;
    }
}