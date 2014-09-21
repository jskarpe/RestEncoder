<?php
namespace Yuav\RestEncoderBundle\Processor;

use Yuav\RestEncoderBundle\Entity\MediaFile;

class MediaFileProcessor
{

    /**
     * Analyze media file
     * 
     * @param string $input
     *            Path to medialfile
     * @return MediaFile
     */
    public function process($inputFile)
    {
        $mediaFile = new MediaFile();
        $mediaFile->setMd5Checksum(md5($inputFile));
        $mediaFile->setFileSizeBytes(filesize($inputFile));
        // $mediaFile->setLabel($label);
        
        $ffprobe = \FFMpeg\FFProbe::create();
        $format = $ffprobe->format($inputFile);
        $streams = $ffprobe->streams($inputFile);
        
        // Common
        $mediaFile->setFormat($format->get('format_name'));
        $mediaFile->setDurationInMs($format->get('duration') * 1000);
        $mediaFile->setTotaltBitrateInKbps($format->get('bit_rate') / 1000);
        
        // Audio
        $audio = $streams->audios()->first();
        $mediaFile->setAudioBitrateInKbps($audio->get('bit_rate') / 1000);
        $mediaFile->setAudioSampleRate($audio->get('sample_rate'));
        $mediaFile->setAudioCodec($audio->get('codec_name'));
        $mediaFile->setChannels($audio->get('channels'));
        
        // Video
        $video = $streams->videos()->first();
        $mediaFile->setFrameRate($video->get('avg_frame_rate'));
        $mediaFile->setVideoBitrateInKbps($video->get('bit_rate') / 1000);
        $mediaFile->setVideoCodec($video->get('codec_name'));
        $dimensions = $video->getDimensions();
        $mediaFile->setWidth($dimensions->getWidth());
        $mediaFile->setHeight($dimensions->getHeight());
        
        return $mediaFile;
    }
}