<?php
namespace Yuav\RestEncoderBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\Producer;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Doctrine\Common\Persistence\ObjectManager;
use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Processor\JobProcessor;
use Psr\Log\LoggerInterface;

class JobConsumer implements ConsumerInterface
{

    private $jobProcessor;

    private $om;
    private $outputQueueProducer;
    private $logger;
    private $lastException;

    public function __construct(ObjectManager $om, Producer $outputQueueProducer, LoggerInterface $logger = null)
    {
        $this->om = $om;
        $this->outputQueueProducer = $outputQueueProducer;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {
        $array = json_decode($msg->body, true);
        $jobId = $array['job_id'];
        
        try {
            if ($this->logger) {
                $this->logger->debug("Received job id '$jobId' from Job queue");
            }
            $job = $this->om->getRepository('\Yuav\RestEncoderBundle\Entity\Job')->find($jobId);
            if (!$job) {
                // Ignore jobs missing from database
                return;
            }
            $jobProcessor = $this->getJobProcessor();
            $job = $jobProcessor->process($job);
            return $job;
        } catch (\RuntimeException $e) {
            if ($this->logger) {
                $this->logger->critical("Failed to process job id '$jobId'. " . $e->getMessage());
            }
           
            /**
             * Returning false will requeue job in RabbitMQ.
             *
             * Any value that is no false will acknowledge the message and remove it
             * from the queue
             */
            return false;
        }
    }

    public function setJobProcessor(JobProcessor $jobProcessor)
    {
        $this->jobProcessor = $jobProcessor;
        return $this;
    }
    
    public function getJobProcessor()
    {
        if (null === $this->jobProcessor) {
            $this->jobProcessor = new JobProcessor($this->om, $this->outputQueueProducer, $this->logger);
        }
        return $this->jobProcessor;
    }
}