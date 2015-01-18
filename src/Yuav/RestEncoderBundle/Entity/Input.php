<?php
namespace Yuav\RestEncoderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Input
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Input
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * An HTTP, S3, Cloud Files, GCS, FTP, FTPS, SFTP, or Aspera URL where we can download file to transcode.
     *
     * @var string @ORM\Column(name="uri", type="string", length=2048)
     */
    private $uri;

    /**
     * @ORM\OneToOne(targetEntity="Job", inversedBy="input", cascade={"all"})
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity="MediaFile", inversedBy="input", cascade={"all"})
     */
    private $mediaFile;

    /**
     *
     * @var string @ORM\Column(name="current_event", type="string", length=100, nullable=true)
     */
    private $currentEvent = 'Queued';

    /**
     *
     * @var string @ORM\Column(name="current_event_progress", type="string", length=100)
     */
    private $currentEventProgress = 0;

    /**
     *
     * @var string @ORM\Column(name="progress", type="string", length=100, nullable=true)
     */
    private $progress;

    public function __toString()
    {
        return (null === $this->getUri()) ? '' : $this->getUri();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        if (null !== $uri && ! is_string($uri)) {
            throw new \InvalidArgumentException('Expected null og string. Got: ' . gettype($uri));
        }
        $this->uri = $uri;
        return $this;
    }

    public function getJob()
    {
        return $this->job;
    }

    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    public function getMediaFile()
    {
        return $this->mediaFile;
    }

    public function setMediaFile(MediaFile $mediaFile)
    {
        $this->mediaFile = $mediaFile;
        return $this;
    }

    public function getCurrentEvent()
    {
        return $this->currentEvent;
    }

    public function setCurrentEvent($currentEvent)
    {
        $this->currentEvent = $currentEvent;
        return $this;
    }

    public function getCurrentEventProgress()
    {
        return $this->currentEventProgress;
    }

    public function setCurrentEventProgress($currentEventProgress)
    {
        $this->currentEventProgress = $currentEventProgress;
        return $this;
    }

    public function getProgress()
    {
        if (null === $this->progress) {
            $this->calculateProgress();
        }
        return $this->progress;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;
        return $this;
    }

    /**
     * Helper function to calculate overall progress
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function calculateProgress()
    {
        $weights = array(
            'Downloading' => 0.9,
            'Analyzing' => 0.1
        );
        
        $progress = 0;
        $e = $this->getCurrentEvent();
        $ep = $this->getCurrentEventProgress()/100;
        switch ($e) {
            default:
                break;
            case 'Downloading':
                $progress = $ep * $weights[$e];
                break;
            case 'Analyzing':
                $progress = $weights['Downloading'] + $ep * $weights[$e];
        }
        $this->progress = $progress * 100;
    }
}