<?php
namespace Yuav\RestEncoderBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\Producer;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Doctrine\Common\Persistence\ObjectManager;
use Monolog;
use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Processor\JobProcessor;
use Psr\Log\LoggerInterface;
use Yuav\RestEncoderBundle\Processor\OutputProcessor;
use FFMpeg\FFMpeg;


class OutputConsumer implements ConsumerInterface
{
    
    private $ffmpeg;
    private $om;
    private $outputProcessor;
    private $logger;

    public function __construct(ObjectManager $om, FFMpeg $ffmpeg, LoggerInterface $logger = null)
    {
        $this->ffmpeg = $ffmpeg;
        $this->om = $om;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {
        $array = json_decode($msg->body, true);
        $outputId = $array['output_id'];
        
        try {
            if ($this->logger) {
                $this->logger->debug("Received output id $outputId from Output queue");
            }
            $output = $this->om->getRepository('\Yuav\RestEncoderBundle\Entity\Output')->find($outputId);
            $outputProcessor = $this->getOutputProcessor();
            $output = $outputProcessor->process($output);
            return $output;
        } catch (\RuntimeException $e) {
            if ($this->logger) {
                $this->logger->critical("Failed to process output id '$outputId'. " . $e->getMessage());
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

    public function getOutputProcessor()
    {
        if (null === $this->outputProcessor) {
            $this->outputProcessor = new OutputProcessor($this->om, $this->ffmpeg, $this->logger);
        }
        return $this->outputProcessor;
    }
    
    public function setOutputProcessor(OutputProcessor $processor)
    {
        $this->outputProcessor = $processor;
        return $this;
    }
}