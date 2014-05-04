<?php

namespace Yuav\RestEncoderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaFile
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MediaFile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=100)
     */
    private $format;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var int
     *
     * @ORM\Column(name="frame_rate", type="integer")
     */
    private $frame_rate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finished_at", type="datetime")
     */
    private $finished_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * @var int
     *
     * @ORM\Column(name="duration_in_ms", type="integer")
     */
    private $duration_in_ms;

    /**
     * @var int
     *
     * @ORM\Column(name="audio_sample_rate", type="integer")
     */
    private $audio_sample_rate;

    /**
 	* @ORM\ManyToOne(targetEntity="Job", cascade={"all"})
 	*/
    private $job;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="error_message", type="string")
     */
    private $error_message;

    /**
     * @var string
     *
     * @ORM\Column(name="error_class", type="string")
     */
    private $error_class;

    /**
     * @var int
     *
     * @ORM\Column(name="audio_bitrate_in_kbps", type="integer")
     */
    private $audio_bitrate_in_kbps;

    /**
     * @var string
     *
     * @ORM\Column(name="audio_codec", type="string")
     */
    private $audio_codec;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="file_size_bytes", type="integer")
     */
    private $file_size_bytes;

    /**
     * @var string
     *
     * @ORM\Column(name="video_codec", type="string")
     */
    private $video_codec;

    /**
     * @var boolean
     *
     * @ORM\Column(name="test", type="boolean")
     */
    private $test;

    /**
     * @var int
     *
     * @ORM\Column(name="totalt_bitrate_in_kbps", type="integer")
     */
    private $totalt_bitrate_in_kbps;

    /**
     * @var int
     *
     * @ORM\Column(name="channels", type="integer")
     */
    private $channels;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="video_bitrate_in_kbps", type="integer")
     */
    private $video_bitrate_in_kbps;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=100)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string")
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="md5_checksum", type="string")
     */
    private $md5_checksum;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return MediaFile
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return MediaFile
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set frame_rate
     *
     * @param \int $frameRate
     * @return MediaFile
     */
    public function setFrameRate(\int $frameRate)
    {
        $this->frame_rate = $frameRate;

        return $this;
    }

    /**
     * Get frame_rate
     *
     * @return \int 
     */
    public function getFrameRate()
    {
        return $this->frame_rate;
    }

    /**
     * Set finished_at
     *
     * @param \DateTime $finishedAt
     * @return MediaFile
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finished_at = $finishedAt;

        return $this;
    }

    /**
     * Get finished_at
     *
     * @return \DateTime 
     */
    public function getFinishedAt()
    {
        return $this->finished_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return MediaFile
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set duration_in_ms
     *
     * @param \int $durationInMs
     * @return MediaFile
     */
    public function setDurationInMs(\int $durationInMs)
    {
        $this->duration_in_ms = $durationInMs;

        return $this;
    }

    /**
     * Get duration_in_ms
     *
     * @return \int 
     */
    public function getDurationInMs()
    {
        return $this->duration_in_ms;
    }

    /**
     * Set audio_sample_rate
     *
     * @param \int $audioSampleRate
     * @return MediaFile
     */
    public function setAudioSampleRate(\int $audioSampleRate)
    {
        $this->audio_sample_rate = $audioSampleRate;

        return $this;
    }

    /**
     * Get audio_sample_rate
     *
     * @return \int 
     */
    public function getAudioSampleRate()
    {
        return $this->audio_sample_rate;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return MediaFile
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set error_message
     *
     * @param string $errorMessage
     * @return MediaFile
     */
    public function setErrorMessage($errorMessage)
    {
        $this->error_message = $errorMessage;

        return $this;
    }

    /**
     * Get error_message
     *
     * @return string 
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * Set error_class
     *
     * @param string $errorClass
     * @return MediaFile
     */
    public function setErrorClass($errorClass)
    {
        $this->error_class = $errorClass;

        return $this;
    }

    /**
     * Get error_class
     *
     * @return string 
     */
    public function getErrorClass()
    {
        return $this->error_class;
    }

    /**
     * Set audio_bitrate_in_kbps
     *
     * @param \int $audioBitrateInKbps
     * @return MediaFile
     */
    public function setAudioBitrateInKbps(\int $audioBitrateInKbps)
    {
        $this->audio_bitrate_in_kbps = $audioBitrateInKbps;

        return $this;
    }

    /**
     * Get audio_bitrate_in_kbps
     *
     * @return \int 
     */
    public function getAudioBitrateInKbps()
    {
        return $this->audio_bitrate_in_kbps;
    }

    /**
     * Set audio_codec
     *
     * @param string $audioCodec
     * @return MediaFile
     */
    public function setAudioCodec($audioCodec)
    {
        $this->audio_codec = $audioCodec;

        return $this;
    }

    /**
     * Get audio_codec
     *
     * @return string 
     */
    public function getAudioCodec()
    {
        return $this->audio_codec;
    }

    /**
     * Set height
     *
     * @param \int $height
     * @return MediaFile
     */
    public function setHeight(\int $height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return \int 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set file_size_bytes
     *
     * @param \int $fileSizeBytes
     * @return MediaFile
     */
    public function setFileSizeBytes(\int $fileSizeBytes)
    {
        $this->file_size_bytes = $fileSizeBytes;

        return $this;
    }

    /**
     * Get file_size_bytes
     *
     * @return \int 
     */
    public function getFileSizeBytes()
    {
        return $this->file_size_bytes;
    }

    /**
     * Set video_codec
     *
     * @param string $videoCodec
     * @return MediaFile
     */
    public function setVideoCodec($videoCodec)
    {
        $this->video_codec = $videoCodec;

        return $this;
    }

    /**
     * Get video_codec
     *
     * @return string 
     */
    public function getVideoCodec()
    {
        return $this->video_codec;
    }

    /**
     * Set test
     *
     * @param boolean $test
     * @return MediaFile
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return boolean 
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set totalt_bitrate_in_kbps
     *
     * @param \int $totaltBitrateInKbps
     * @return MediaFile
     */
    public function setTotaltBitrateInKbps(\int $totaltBitrateInKbps)
    {
        $this->totalt_bitrate_in_kbps = $totaltBitrateInKbps;

        return $this;
    }

    /**
     * Get totalt_bitrate_in_kbps
     *
     * @return \int 
     */
    public function getTotaltBitrateInKbps()
    {
        return $this->totalt_bitrate_in_kbps;
    }

    /**
     * Set channels
     *
     * @param \int $channels
     * @return MediaFile
     */
    public function setChannels(\int $channels)
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * Get channels
     *
     * @return \int 
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * Set width
     *
     * @param \int $width
     * @return MediaFile
     */
    public function setWidth(\int $width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return \int 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set video_bitrate_in_kbps
     *
     * @param \int $videoBitrateInKbps
     * @return MediaFile
     */
    public function setVideoBitrateInKbps(\int $videoBitrateInKbps)
    {
        $this->video_bitrate_in_kbps = $videoBitrateInKbps;

        return $this;
    }

    /**
     * Get video_bitrate_in_kbps
     *
     * @return \int 
     */
    public function getVideoBitrateInKbps()
    {
        return $this->video_bitrate_in_kbps;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return MediaFile
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return MediaFile
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set md5_checksum
     *
     * @param string $md5Checksum
     * @return MediaFile
     */
    public function setMd5Checksum($md5Checksum)
    {
        $this->md5_checksum = $md5Checksum;

        return $this;
    }

    /**
     * Get md5_checksum
     *
     * @return string 
     */
    public function getMd5Checksum()
    {
        return $this->md5_checksum;
    }
}
