<?php
namespace Yuav\RestEncoderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Yuav\RestEncoderBundle\Model\JobInterface;

/**
 * Job
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Job implements JobInterface
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
     * @var \DateTime @ORM\Column(name="submitted_at", type="datetime")
     */
    private $submittedAt;

    /**
     *
     * @var MediaFile @ORM\OneToOne(targetEntity="MediaFile", mappedBy="job", cascade={"persist"})
     */
    private $inputMediaFile;

    /**
     *
     * @var boolean @ORM\Column(name="test", type="boolean", nullable=true)
     */
    private $test;

    /**
     *
     * @var array @ORM\OneToMany(targetEntity="MediaFile", mappedBy="job", cascade={"persist"})
     */
    private $outputMediaFiles;

    /**
     *
     * @var array @ORM\OneToMany(targetEntity="Thumbnail", mappedBy="job")
     */
    private $thumbnails;

    /**
     *
     * @var string @ORM\Column(name="state", type="string", length=100)
     */
    private $state;

    /**
     *
     * @var string @ORM\Column(name="current_event", type="string", length=100, nullable=true)
     */
    private $current_event;

    /**
     *
     * @var string @ORM\Column(name="current_event_progress", type="string", length=100, nullable=true)
     */
    private $current_event_progress;

    /**
     *
     * @var string @ORM\Column(name="progress", type="string", length=100, nullable=true)
     */
    private $progress;

    /**
     * The API key for your account
     *
     * @var string @ORM\Column(name="api_key", type="string", length=100, nullable=true)
     */
    private $apiKey;

    /**
     * An HTTP, S3, Cloud Files, GCS, FTP, FTPS, SFTP, or Aspera URL where we can download file to transcode.
     *
     * @var string @ORM\Column(name="input", type="string", length=2048)
     */
    private $input;

    /**
     * Create a Live streaming job.
     *
     * @var boolean @ORM\Column(name="live_stream", type="boolean")
     */
    private $liveStream = false;

    /**
     *
     * @var array @ORM\OneToMany(targetEntity="Output", mappedBy="job", cascade={"persist", "remove"})
     */
    private $outputs;

    /**
     * NA: The region where a file is processed
     *
     * @var string @ORM\Column(name="region", type="string", nullable=true)
     */
    private $region;

    /**
     * NA: The region where a file is processed
     *
     * @var integer @ORM\Column(name="download_connections", type="smallint")
     */
    private $downloadConnections = 5;

    /**
     * NA: Optional information to store alongside this job.
     *
     * @var string @ORM\Column(name="pass_through", type="string", nullable=true)
     */
    private $passThrough;

    /**
     * Send a mocked job request
     *
     * @var boolean @ORM\Column(name="mock", type="boolean")
     */
    private $mock = false;

    /**
     * Job private
     *
     * @var boolean @ORM\Column(name="private", type="boolean")
     */
    private $private = false;

    /**
     * NA: A report grouping for this job.
     *
     * @var string @ORM\Column(name="grouping", type="string", nullable=true)
     */
    private $grouping;

    /**
     * NA: How to allocate available bandwidth for Aspera file transfers.
     *
     * @var string @ORM\Column(name="aspera_transfer_policy", type="string")
     */
    private $asperaTransferPolicy = 'fair';

    /**
     * NA: A targeted rate in Kbps for data transfer minimums.
     *
     * @var integer @ORM\Column(name="transfer_minimum_rate", type="integer")
     */
    private $transferMinimumRate = 1000;

    /**
     * NA: A targeted rate in Kbps for data transfer maximums.
     *
     * @var integer @ORM\Column(name="transfer_maximum_rate", type="integer")
     */
    private $transferMaximumRate = 250000;

    /**
     * NA: The expected checksum of the input file
     *
     * @var string @ORM\Column(name="expected_md5_checksum", type="string", nullable=true)
     */
    private $expectedMd5Checksum;

    /**
     * NA: References saved credentials by a nickname
     *
     * @var string @ORM\Column(name="credentials", type="string", nullable=true)
     */
    private $credentials;

    public function __construct()
    {
        $this->downloadConnections = 4;
        $this->test = false;
        $this->state = 'new';
        $this->outputs = new ArrayCollection();
        $this->outputMediaFiles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * Set api key
     *
     * @param string $apiKey            
     * @return Job
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Get api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set aspera transfer policy
     *
     * @param string $asperaTransferPolicy            
     * @return Job
     */
    public function setAsperaTransferPolicy($asperaTransferPolicy)
    {
        if (null === $asperaTransferPolicy) {
            // Reset to default
            $tmpJob = new Job();
            $asperaTransferPolicy = $tmpJob->getAsperaTransferPolicy();
        }
        
        $this->asperaTransferPolicy = $asperaTransferPolicy;
        return $this;
    }

    /**
     * Get aspera transfer policy
     *
     * @return string
     */
    public function getAsperaTransferPolicy()
    {
        return $this->asperaTransferPolicy;
    }

    /**
     * Set credentials
     *
     * @param string $credentials            
     * @return Job
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * Get credentials
     *
     * @return string
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set download connections
     *
     * @param string $downloadConnections            
     * @return Job
     */
    public function setDownloadConnections($downloadConnections)
    {
        if (null === $downloadConnections) {
            // Reset to default
            $tmpJob = new Job();
            $downloadConnections = $tmpJob->getDownloadConnections();
        }
        $this->downloadConnections = $downloadConnections;
        return $this;
    }

    /**
     * Get download connections
     *
     * @return string
     */
    public function getDownloadConnections()
    {
        return $this->downloadConnections;
    }

    /**
     * Set expected md5 checksum
     *
     * @param string $expectedMd5Checksum            
     * @return Job
     */
    public function setExpectedMd5Checksum($expectedMd5Checksum)
    {
        $this->expectedMd5Checksum = $expectedMd5Checksum;
        return $this;
    }

    /**
     * Get expected md5 checksum
     *
     * @return string
     */
    public function getExpectedMd5Checksum()
    {
        return $this->expectedMd5Checksum;
    }

    /**
     * Set finished_at
     *
     * @param \DateTime $finishedAt            
     * @return Job
     */
    public function setFinishedAt(\DateTime $finishedAt)
    {
        $this->finishedAt = $finishedAt;
        
        return $this;
    }

    /**
     * Get finished_at
     *
     * @return \DateTime
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * Set grouping
     *
     * @param string $grouping            
     * @return Job
     */
    public function setGrouping($grouping)
    {
        $this->grouping = $grouping;
        
        return $this;
    }

    /**
     * Get grouping
     *
     * @return string
     */
    public function getGrouping()
    {
        return $this->grouping;
    }

    /**
     * Set live stream
     *
     * @param boolean $liveStream            
     * @return Job
     */
    public function setLiveStream($liveStream)
    {
        $this->liveStream = $liveStream;
        
        return $this;
    }

    /**
     * Get live stream
     *
     * @return boolean
     */
    public function getLiveStream()
    {
        return $this->liveStream;
    }

    /**
     * Get mock
     *
     * @return boolean
     */
    public function getMock()
    {
        return $this->mock;
    }

    /**
     * Set live stream
     *
     * @param boolean $mock            
     * @return Job
     */
    public function setMock($mock)
    {
        $this->mock = $mock;
        
        return $this;
    }

    /**
     * Get outputs
     *
     * @return array
     */
    public function getOutputs()
    {
        return $this->outputs;
    }

    /**
     * Set outputs
     *
     * @param array $outputs            
     * @return Job
     */
    public function setOutputs(ArrayCollection $outputs)
    {
        $this->outputs = $outputs;
        foreach ($outputs as $output) {
            if ($output instanceof Output) {
                $output->setJob($this);
            }
        }
        return $this;
    }

    public function addOutput(Output $output)
    {
        $this->outputs->add($output);
        $output->setJob($this);
        return $this;
    }

    public function removeOutput($output)
    {
        if ($this->outputs->contains($output)) {
            $output->setJob(null);
            $this->outputs->removeElement($output);
        }
        return $this;
    }

    /**
     * Set private
     *
     * @param boolean $private            
     * @return Job
     */
    public function setPrivate($private)
    {
        $this->private = $private;
        
        return $this;
    }

    /**
     * Get private
     *
     * @return boolean
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * Set region
     *
     * @param string $region            
     * @return Job
     */
    public function setRegion($region)
    {
        $this->region = $region;
        
        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set transfer maximum rate
     *
     * @param string $transferMaxiumRate            
     * @return Job
     */
    public function setTransferMaximumRate($transferMaxiumRate)
    {
        if (null === $transferMaxiumRate) {
            // Reset to default
            $tmpJob = new Job();
            $transferMaxiumRate = $tmpJob->getTransferMaximumRate();
        }
        $this->transferMaximumRate = $transferMaxiumRate;
        
        return $this;
    }

    /**
     * Get transfer maximum rate
     *
     * @return string
     */
    public function getTransferMaximumRate()
    {
        return $this->transferMaximumRate;
    }

    /**
     * Set transfer minimum rate
     *
     * @param string $transferMinimumRate            
     * @return Job
     */
    public function setTransferMinimumRate($transferMinimumRate)
    {
        if (null === $transferMinimumRate) {
            // Reset to default
            $tmpJob = new Job();
            $transferMinimumRate = $tmpJob->getTransferMinimumRate();
        }
        $this->transferMinimumRate = $transferMinimumRate;
        
        return $this;
    }

    /**
     * Get transfer minimum rate
     *
     * @return string
     */
    public function getTransferMinimumRate()
    {
        return $this->transferMinimumRate;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt            
     * @return Job
     */
    public function setUpdatedAt(\DateTime $updatedAt)
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
     * Set submitted_at
     *
     * @param \DateTime $submittedAt            
     * @return Job
     */
    public function setSubmittedAt(\DateTime $submittedAt)
    {
        $this->submittedAt = $submittedAt;
        
        return $this;
    }

    /**
     * Get submitted_at
     *
     * @return \DateTime
     */
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * Set pass_through
     *
     * @param boolean $passThrough            
     * @return Job
     */
    public function setPassThrough($passThrough)
    {
        $this->passThrough = $passThrough;
        
        return $this;
    }

    /**
     * Get pass_through
     *
     * @return boolean
     */
    public function getPassThrough()
    {
        return $this->passThrough;
    }

    /**
     * Set input
     *
     * @param string $input            
     * @return Job
     */
    public function setInput($input)
    {
        $this->input = $input;
        
        return $this;
    }

    /**
     * Get input
     *
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set input media file
     *
     * @param MediaFile $inputMediaFile            
     * @return Job
     */
    public function setInputMediaFile(MediaFile $inputMediaFile)
    {
        $this->inputMediaFile = $inputMediaFile;
        $inputMediaFile->setJob($this);
        return $this;
    }

    /**
     * Get input_media_file
     *
     * @return MediaFile
     */
    public function getInputMediaFile()
    {
        return $this->inputMediaFile;
    }

    /**
     * Set test
     *
     * @param boolean $test            
     * @return Job
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
     * Set output media files
     *
     * @param array $outputMediaFiles            
     * @return Job
     */
    public function setOutputMediaFiles(ArrayCollection $outputMediaFiles = null)
    {
        $this->outputMediaFiles = $outputMediaFiles;
        if (null !== $outputMediaFiles) {
            foreach ($outputMediaFiles as $outputMediaFile) {
                if ($outputMediaFile instanceof MediaFile) {
                    $outputMediaFile->setJob($this);
                } else {
                    throw \InvalidArgumentException("Expected ArrayCollection with MediaFile objects, found type: " . gettype($outputMediaFile));
                }
            }
        }
        return $this;
    }

    /**
     * Get output_media_files
     *
     * @return ArrayCollection
     */
    public function getOutputMediaFiles()
    {
        return $this->outputMediaFiles;
    }

    public function addOutputMediaFile(MediaFile $mediaFile)
    {
        $this->outputMediaFiles->add($mediaFile);
        $mediaFile->setJob($this);
        return $this;
    }

    public function removeOutputMediaFile($mediaFile)
    {
        if ($this->outputMediaFiles->contains($mediaFile)) {
            $this->outputMediaFiles->removeElement($mediaFile);
        }
        return $this;
    }

    /**
     * Set thumbnails
     *
     * @param array $thumbnails            
     * @return Job
     */
    public function setThumbnails($thumbnails)
    {
        $this->thumbnails = $thumbnails;
        
        return $this;
    }

    /**
     * Get thumbnails
     *
     * @return array
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }

    /**
     * Set state
     *
     * @param string $state            
     * @return Job
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
     * @ORM\PrePersist
     */
    public function populateSubmittedAt()
    {
        $this->setSubmittedAt(new \DateTime('now'));
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function populateUpdatedAt()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }

    public function getCurrentEvent()
    {
        return $this->current_event;
    }

    public function setCurrentEvent($current_event)
    {
        $this->current_event = $current_event;
        return $this;
    }

    public function getCurrentEventProgress()
    {
        return $this->current_event_progress;
    }

    public function setCurrentEventProgress($current_event_progress)
    {
        $this->current_event_progress = $current_event_progress;
        return $this;
    }

    public function getProgress()
    {
        return $this->progress;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;
        return $this;
    }
}
