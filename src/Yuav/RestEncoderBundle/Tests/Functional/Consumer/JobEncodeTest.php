<?php
namespace Yuav\RestEncoderBundle\Tests\Functional\Consumer;


use PhpAmqpLib\Message\AMQPMessage;
use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Consumer\JobConsumer;
use Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobData;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;
use Doctrine\ORM\Tools\SchemaTool;
use Yuav\RestEncoderBundle\Consumer\OutputConsumer;
use Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobMp4SampleEncode;
use FFMpeg\FFMpeg;


class JobEncodeTest extends WebTestCase
{
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    
    private $outputQueueProducer;
    
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
        ->get('doctrine')
        ->getManager()
        ;
        $this->outputQueueProducer = static::$kernel->getContainer()->get('old_sound_rabbit_mq.output_queue_producer');
    }
    
    public function testEncodeJobItem()
    {
        $fixtures = array (
            'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\LoadJobMp4SampleEncode'
        );
        $this->loadFixtures ( $fixtures );
        $jobs = LoadJobMp4SampleEncode::$jobs;
        $job = array_pop($jobs);
        
        $msg = new AMQPMessage();
        $msg->body = json_encode(array('job_id' => $job->getId()));
        $jobConsumer = new JobConsumer($this->em,  $this->outputQueueProducer);
        $job = $jobConsumer->execute($msg);
        
        $this->assertInstanceOf('\Yuav\RestEncoderBundle\Entity\Job', $job);
        $this->assertCount(1, $job->getOutputs());
        $outputConsumer = new OutputConsumer($this->em, FFMpeg::create());
        foreach ($job->getOutputs() as $output) {
            $msg = new AMQPMessage();
            $msg->body = json_encode(array('output_id' => $output->getId()));
            $output = $outputConsumer->execute($msg);
            $this->assertInstanceOf('\Yuav\RestEncoderBundle\Entity\Output', $output);
        }
    }
    
    /**
     * Workaround for MakeGood integration
     */
    protected static function createKernel(array $options = array()) {
        require_once realpath ( dirname ( __file__ ) . '/../../../../../../' ) . '/app/AppKernel.php';
    
        return new \AppKernel ( isset ( $options ['environment'] ) ? $options ['environment'] : 'test', isset ( $options ['debug'] ) ? $options ['debug'] : true );
    }
}