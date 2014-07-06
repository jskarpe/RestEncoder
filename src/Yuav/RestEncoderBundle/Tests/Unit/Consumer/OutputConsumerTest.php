<?php
namespace Yuav\RestEncoderBundle\Tests\Unit\Consumer;


use PhpAmqpLib\Message\AMQPMessage;
use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Consumer\JobConsumer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Yuav\RestEncoderBundle\Consumer\OutputConsumer;
use FFMpeg\FFMpeg;

class OutputConsumerTest extends WebTestCase
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
    
    public function testProcessOutputQueueItem()
    {
        // First, mock the object to be used in the test
        $output = $this->getMock('\Yuav\RestEncoderBundle\Entity\Output');
        
        // Now, mock the repository so it returns the mock of the employee
        $jobRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
        ->disableOriginalConstructor()
        ->getMock();
        $jobRepository->expects($this->once())
        ->method('find')
        ->will($this->returnValue($output));
        
        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
        ->disableOriginalConstructor()
        ->getMock();
        $entityManager->expects($this->once())
        ->method('getRepository')
        ->will($this->returnValue($jobRepository));

        // Inject mock to consumer
        $consumer = new OutputConsumer($entityManager, FFMpeg::create());
        
        $queueMsg = new AMQPMessage();
        $queueMsg->body = json_encode(array('output_id' => $output->getId()));
        
        // Mock processor
        $processor = $this->getMockBuilder('\Yuav\RestEncoderBundle\Processor\OutputProcessor')
        ->disableOriginalConstructor()
        ->getMock();
        $processor->expects($this->once())->method('process')->will($this->returnValue(null));
        $consumer->setOutputProcessor($processor);
        
        $result = $consumer->execute($queueMsg);
        $this->assertTrue(false !== $result);
    }
    
    public function testRuntimeExceptionWillReturnFalse()
    {
        // First, mock the object to be used in the test
        $entity = $this->getMock('\Yuav\RestEncoderBundle\Entity\Output');

        // Now, mock the repository so it returns the mock of the employee
        $repository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
        ->disableOriginalConstructor()
        ->getMock();
        $repository->expects($this->once())
        ->method('find')
        ->will($this->returnValue($entity));
        
        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
        ->disableOriginalConstructor()
        ->getMock();
        $entityManager->expects($this->once())
        ->method('getRepository')
        ->will($this->returnValue($repository));

        // Inject mock to consumer
        $consumer = new OutputConsumer($entityManager, FFMpeg::create());
        
        $queueMsg = new AMQPMessage();
        $queueMsg->body = json_encode(array('output_id' => 123));
        
        
        // Mock processor
        $processor = $this->getMockBuilder('\Yuav\RestEncoderBundle\Processor\OutputProcessor')
        ->disableOriginalConstructor()
        ->getMock();
        $processor->expects($this->once())->method('process')->will($this->throwException(new \RuntimeException));
        $consumer->setOutputProcessor($processor);
        
        $result = $consumer->execute($queueMsg);
        $this->assertFalse($result);
    }
    
    /**
     * Workaround for MakeGood integration
     */
    protected static function createKernel(array $options = array()) {
        require_once realpath ( dirname ( __file__ ) . '/../../../../../../' ) . '/app/AppKernel.php';
    
        return new \AppKernel ( isset ( $options ['environment'] ) ? $options ['environment'] : 'test', isset ( $options ['debug'] ) ? $options ['debug'] : true );
    }
}