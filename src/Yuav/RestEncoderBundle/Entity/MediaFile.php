<?php
namespace Yuav\RestEncoderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaFile
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class MediaFile
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="format", type="string", length=100)
     */
    private $format;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     *
     * @var int @ORM\Column(name="frame_rate", type="string")
     */
    private $frameRate;

    /**
     *
     * @var \DateTime @ORM\Column(name="finished_at", type="datetime", nullable=true)
     */
    private $finishedAt;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     *
     * @var int @ORM\Column(name="duration_in_ms", type="integer")
     */
    private $durationInMs;

    /**
     *
     * @var int @ORM\Column(name="audio_sample_rate", type="integer")
     */
    private $audioSampleRate;

    /**
     * @ORM\ManyToOne(targetEntity="Job", cascade={"all"})
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity="Output", inversedBy="outputMediaFile", cascade={"all"})
     */
    private $output;
    
    /**
     *
     * @var string @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     *
     * @var string @ORM\Column(name="error_message", type="string", nullable=true)
     */
    private $errorMessage;

    /**
     *
     * @var string @ORM\Column(name="error_class", type="string", nullable=true)
     */
    private $errorClass;

    /**
     *
     * @var int @ORM\Column(name="audio_bitrate_in_kbps", type="integer")
     */
    private $audioBitrateInKbps;

    /**
     *
     * @var string @ORM\Column(name="audio_codec", type="string")
     */
    private $audioCodec;

    /**
     *
     * @var int @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     *
     * @var int @ORM\Column(name="file_size_bytes", type="integer")
     */
    private $fileSizeBytes;

    /**
     *
     * @var string @ORM\Column(name="video_codec", type="string")
     */
    private $videoCodec;

    /**
     *
     * @var boolean @ORM\Column(name="test", type="boolean")
     */
    private $test = false;

    /**
     *
     * @var int @ORM\Column(name="totalt_bitrate_in_kbps", type="integer")
     */
    private $totaltBitrateInKbps;

    /**
     *
     * @var int @ORM\Column(name="channels", type="integer")
     */
    private $channels;

    /**
     *
     * @var int @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     *
     * @var int @ORM\Column(name="video_bitrate_in_kbps", type="integer")
     */
    private $videoBitrateInKbps;

    /**
     *
     * @var string @ORM\Column(name="state", type="string", length=100)
     */
    private $state = 'new';

    /**
     *
     * @var string @ORM\Column(name="label", type="string", nullable=true)
     */
    private $label;

    /**
     *
     * @var string @ORM\Column(name="md5_checksum", type="string")
     */
    private $md5Checksum;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

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
        $this->createdAt = $createdAt;
        
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set frame rate
     *
     * @param integer $frameRate            
     * @return MediaFile
     */
    public function setFrameRate($frameRate)
    {
        $this->frameRate = $frameRate;
        
        return $this;
    }

    /**
     * Get frame rate
     *
     * @return int
     */
    public function getFrameRate()
    {
        return $this->frameRate;
    }

    /**
     * Set finished at
     *
     * @param \DateTime $finishedAt            
     * @return MediaFile
     */
    public function setFinishedAt(\DateTime $finishedAt)
    {
        $this->finishedAt = $finishedAt;
        
        return $this;
    }

    /**
     * Get finished at
     *
     * @return \DateTime
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * Set updated at
     *
     * @param \DateTime $updatedAt            
     * @return MediaFile
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set duration_in_ms
     *
     * @param \int $durationInMs            
     * @return MediaFile
     */
    public function setDurationInMs($durationInMs)
    {
        $this->durationInMs = $durationInMs;
        
        return $this;
    }

    /**
     * Get duration_in_ms
     *
     * @return \int
     */
    public function getDurationInMs()
    {
        return $this->durationInMs;
    }

    /**
     * Set audio_sample_rate
     *
     * @param \int $audioSampleRate            
     * @return MediaFile
     */
    public function setAudioSampleRate($audioSampleRate)
    {
        $this->audioSampleRate = $audioSampleRate;
        
        return $this;
    }

    /**
     * Get audio_sample_rate
     *
     * @return \int
     */
    public function getAudioSampleRate()
    {
        return $this->audioSampleRate;
    }

    /**
     * Set job
     *
     * @param string $job            
     * @return MediaFile
     */
    public function setJob(Job $job)
    {
        $this->job = $job;
        
        return $this;
    }

    /**
     * Get job
     *
     * @return Job
     */
    public function getJob()
    {
        return $this->job;
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
        $this->errorMessage = $errorMessage;
        
        return $this;
    }

    /**
     * Get error_message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set error_class
     *
     * @param string $errorClass            
     * @return MediaFile
     */
    public function setErrorClass($errorClass)
    {
        $this->errorClass = $errorClass;
        
        return $this;
    }

    /**
     * Get error_class
     *
     * @return string
     */
    public function getErrorClass()
    {
        return $this->errorClass;
    }

    /**
     * Set audio_bitrate_in_kbps
     *
     * @param \int $audioBitrateInKbps            
     * @return MediaFile
     */
    public function setAudioBitrateInKbps($audioBitrateInKbps)
    {
        $this->audioBitrateInKbps = $audioBitrateInKbps;
        
        return $this;
    }

    /**
     * Get audio_bitrate_in_kbps
     *
     * @return \int
     */
    public function getAudioBitrateInKbps()
    {
        return $this->audioBitrateInKbps;
    }

    /**
     * Set audio_codec
     *
     * @param string $audioCodec            
     * @return MediaFile
     */
    public function setAudioCodec($audioCodec)
    {
        $this->audioCodec = $audioCodec;
        
        return $this;
    }

    /**
     * Get audio_codec
     *
     * @return string
     */
    public function getAudioCodec()
    {
        return $this->audioCodec;
    }

    /**
     * Set height
     *
     * @param \int $height            
     * @return MediaFile
     */
    public function setHeight($height)
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
    public function setFileSizeBytes($fileSizeBytes)
    {
        $this->fileSizeBytes = $fileSizeBytes;
        
        return $this;
    }

    /**
     * Get file_size_bytes
     *
     * @return \int
     */
    public function getFileSizeBytes()
    {
        return $this->fileSizeBytes;
    }

    /**
     * Set video_codec
     *
     * @param string $videoCodec            
     * @return MediaFile
     */
    public function setVideoCodec($videoCodec)
    {
        $this->videoCodec = $videoCodec;
        
        return $this;
    }

    /**
     * Get video_codec
     *
     * @return string
     */
    public function getVideoCodec()
    {
        return $this->videoCodec;
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
    public function setTotaltBitrateInKbps($totaltBitrateInKbps)
    {
        $this->totaltBitrateInKbps = $totaltBitrateInKbps;
        
        return $this;
    }

    /**
     * Get totalt_bitrate_in_kbps
     *
     * @return \int
     */
    public function getTotaltBitrateInKbps()
    {
        return $this->totaltBitrateInKbps;
    }

    /**
     * Set channels
     *
     * @param \int $channels            
     * @return MediaFile
     */
    public function setChannels($channels)
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
    public function setWidth($width)
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
    public function setVideoBitrateInKbps($videoBitrateInKbps)
    {
        $this->videoBitrateInKbps = $videoBitrateInKbps;
        
        return $this;
    }

    /**
     * Get video_bitrate_in_kbps
     *
     * @return \int
     */
    public function getVideoBitrateInKbps()
    {
        return $this->videoBitrateInKbps;
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
        $this->md5Checksum = $md5Checksum;
        
        return $this;
    }

    /**
     * Get md5_checksum
     *
     * @return string
     */
    public function getMd5Checksum()
    {
        return $this->md5Checksum;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function populateUpdatedAt()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }
	
}
