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

class TestJobCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('restencoder:testjob')->setDescription('Add test job to RabbitMQ queue');
    }

    protected function execute(InputInterface $inputInterface, OutputInterface $outputInterface)
    {
        $job = new Job();
        $job->setInput('http://vjs.zencdn.net/v/oceans.mp4');
        $job->setApiKey('dummy');
        
        $output = new Output();
        $output->setUrl('http://upload_file_here');
        $job->addOutput($output);
        
        $em = $this->getEntityManager();
        
        $em->persist($job);
        $em->flush($job);
        
        $msg = array(
            'job_id' => $job->getId()
        );
        
        $producer = $this->getQueueProducer();
        $producer->publish(json_encode($msg));
        
        $outputInterface->writeln("Added job: " . $job->getId());
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

    public function getQueueProducer()
    {
        return $this->getContainer()->get('old_sound_rabbit_mq.job_queue_producer');
    }
}