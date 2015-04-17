<?php
namespace Yuav\RestEncoderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;
use FFMpeg\FFMpeg;
use Yuav\RestEncoderBundle\Entity\Job;
use Alchemy\BinaryDriver\Listeners\DebugListener;
use Yuav\RestEncoderBundle\Entity\Output;
use Alchemy\BinaryDriver\Exception\InvalidArgumentException;
use Yuav\RestEncoderBundle\Processor\JobProcessor;
use Yuav\RestEncoderBundle\Processor\OutputProcessor;

class ProcessQueueCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('restencoder:process_queue')->setDescription('Process AMQP queue message');
        $this->addArgument('message', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $outputInterface)
    {
        $message = $input->getArgument('message');
        $message = base64_decode($message);
        $array = json_decode($message, true);
        
        if (isset($array['output_id'])) {
            $outputId = $array['output_id'];
            try {
                $outputInterface->writeln("Received output id $outputId from Output queue");
                $this->processOutput($outputId);
                $outputInterface->writeln('Successfully processed output: ' . $outputId);
            } catch (\RuntimeException $e) {
                $outputInterface->writeln("Failed to process output id '$outputId'. " . $e->getMessage());
            }
        } elseif (isset($array['job_id'])) {
            $jobId = $array['job_id'];
            $outputInterface->writeln("Recieved job id $jobId from Job queue");
            $this->processJob($jobId);
            $outputInterface->writeln('Successfully processed job: ' . $jobId);
        } else {
            $outputInterface->writeln('Unrecognized message: ' . $message);
        }
        
        exit(0);
    }

    public function processJob($jobId)
    {
        $job = $this->getEntityManager()
            ->getRepository('\Yuav\RestEncoderBundle\Entity\Job')
            ->find($jobId);
        if ($job) {
            $jobProcessor = $this->getJobProcessor();
            $job = $jobProcessor->process($job);
        }
    }

    public function processOutput($outputId)
    {
        $output = $this->getEntityManager()
            ->getRepository('\Yuav\RestEncoderBundle\Entity\Output')
            ->find($outputId);
        if ($output) {
            $outputProcessor = $this->getOutputProcessor();
            $output = $outputProcessor->process($output);
        }
    }

    /**
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        $em = $this->getContainer()
            ->get('doctrine')
            ->getManager();
        return $em;
    }

    public function getJobProcessor()
    {
        return $this->getContainer()->get('yuav_rest_encoder.job_processor');
    }

    public function getOutputProcessor()
    {
        return $this->getContainer()->get('yuav_rest_encoder.output_processor');
    }
}