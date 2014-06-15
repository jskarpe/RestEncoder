<?php
namespace Yuav\RestEncoderBundle\Processor\Output;

use Yuav\RestEncoderBundle\Entity\Output;
use FFMpeg\Media\Video;
use Yuav\RestEncoderBundle\Entity\MediaFile;
use Yuav\RestEncoderBundle\Processor\Output\Translator\Size;
use FFMpeg\Filters\Video\ResizeFilter;

class Translator
{

    public function addFFMpegFilters(Video $video, MediaFile $inputMediaFile, Output $output)
    {
        $video->filters()
            ->resize($this->getResizeFilter($inputMediaFile, $output))
            ->synchronize();
    }

    public function getResizeFilter(MediaFile $input, Output $output)
    {
        $size = new Size();
        list ($targetWidth, $targetHeight) = $size->findTargetDimensions($input->getWidth(), $input->getHeight(), $output);
        $resizeMode = $size->getResizeMode($output->getAspectMode());
        return new \FFMpeg\Coordinate\Dimension($targetWidth, $targetHeight, ResizeFilter::RESIZEMODE_INSET);
    }

    public function getFFMpegFormatFromOutput(Output $output)
    {
        switch ($output->getFormat()) {
            case 'mp4':
                $audioCodec = ($output->getAudioCodec() == 'lame') ? 'libmp3lame' : 'libvo_aacenc';
                $format = new \FFMpeg\Format\Video\X264($audioCodec);
                break;
            case 'webm':
                $format = new \FFMpeg\Format\Video\WebM();
                break;
            default:
                throw new \InvalidArgumentException('Unsupported format: ' . $output->getFormat());
        }
        return $format;
    }
}