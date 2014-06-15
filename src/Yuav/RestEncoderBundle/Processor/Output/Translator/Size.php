<?php
namespace Yuav\RestEncoderBundle\Processor\Output\Translator;

use Yuav\RestEncoderBundle\Entity\Output;
use FFMpeg\Filters\Video\ResizeFilter;

class Size
{

    public function findTargetDimensions($originalWidth, $originalHeight, Output $output)
    {
        // If sizes match, or output has nothing set, no further processing needed
        if ($originalWidth == $output->getWidth() && $originalHeight == $output->getHeight() || 0 == $output->getWidth() && 0 == $output->getHeight()) {
            return array(
                $originalWidth,
                $originalHeight
            );
        }
        
        // Find max valid dimensions
        $ratio = $this->findRatio($originalWidth, $originalHeight, $output);
        if ($ratio < 1) {
            $maxHeight = $output->getHeight();
            $targetHeight = $this->findTargetNumber($originalHeight, $maxHeight, $output->getUpscale());
            $targetWidth = $targetHeight * $ratio;
        } else {
            $maxWidth = $output->getWidth();
            $targetWidth = $this->findTargetNumber($originalWidth, $maxWidth);
            $targetHeight = $targetWidth / $ratio;
        }
        
        return array(
            $targetWidth,
            $targetHeight
        );
    }

    public function getResizeMode($aspectMode = 'preserve')
    {
        $resizeMode = ResizeFilter::RESIZEMODE_INSET;
        switch ($aspectMode) {
            case 'stretch':
                $resizeMode = ResizeFilter::RESIZEMODE_FIT;
                break;
            default:
            case 'crop':
            case 'pad':
            case 'preserve':
                $resizeMode = ResizeFilter::RESIZEMODE_INSET;
        }
        return $resizeMode;
    }

    private function findTargetNumber($original, $max, $upscale = false)
    {
        $target = $max;
        if (false == $upscale && $max > $original) {
            $target = $original;
        }
        return $target;
    }

    public function findRatio($originalWidth, $originalHeight, Output $output)
    {
        $ratio = 1;
        switch ($output->getAspectMode()) {
            case 'preserve':
                $ratio = $originalWidth / $originalHeight;
            case 'stretch':
            case 'crop':
            case 'pad':
                $ratio = $output->getWidth() / $output->getHeight();
            default:
                throw new \InvalidArgumentException(__METHOD__ . ' Unexpcted aspactmode for output: ' . $output->getAspectMode() . ' Supported modes are: preserve, stretch, crop and pad');
        }
        return $ratio;
    }
}