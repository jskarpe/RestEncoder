<?php
namespace Yuav\RestEncoderBundle\Tests\Unit\Consumer;


use PhpAmqpLib\Message\AMQPMessage;
use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Consumer\JobConsumer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobConsumerTest extends WebTestCase
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
    
    public function testProcessJobQueueItem()
    {
        // First, mock the object to be used in the test
        $job = $this->getMock('\Yuav\RestEncoderBundle\Entity\Job');
        
        // Now, mock the repository so it returns the mock of the employee
        $jobRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
        ->disableOriginalConstructor()
        ->getMock();
        $jobRepository->expects($this->once())
        ->method('find')
        ->will($this->returnValue($job));
        
        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
        ->disableOriginalConstructor()
        ->getMock();
        $entityManager->expects($this->once())
        ->method('getRepository')
        ->will($this->returnValue($jobRepository));

        // Inject mock to consumer
        $consumer = new JobConsumer($entityManager, $this->outputQueueProducer);
        
        $jobQueueMsg = new AMQPMessage();
        $jobQueueMsg->body = json_encode(array('job_id' => $job->getId()));
        
        // Mock processor
        $jp = $this->getMockBuilder('\Yuav\RestEncoderBundle\Processor\JobProcessor')
        ->disableOriginalConstructor()
        ->getMock();
        $jp->expects($this->once())->method('process')->will($this->returnValue(null));
        $consumer->setJobProcessor($jp);
        
        $result = $consumer->execute($jobQueueMsg);
        $this->assertTrue(false !== $result);
    }
    
    public function testRuntimeExceptionWillReturnFalse()
    {
        // First, mock the object to be used in the test
        $job = $this->getMock('\Yuav\RestEncoderBundle\Entity\Job');

        // Now, mock the repository so it returns the mock of the employee
        $jobRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
        ->disableOriginalConstructor()
        ->getMock();
        $jobRepository->expects($this->once())
        ->method('find')
        ->will($this->returnValue($job));
        
        // Last, mock the EntityManager to return the mock of the repository
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
        ->disableOriginalConstructor()
        ->getMock();
        $entityManager->expects($this->once())
        ->method('getRepository')
        ->will($this->returnValue($jobRepository));

        // Inject mock to consumer
        $consumer = new JobConsumer($entityManager, $this->outputQueueProducer);
        
        $jobQueueMsg = new AMQPMessage();
        $jobQueueMsg->body = json_encode(array('job_id' => 123));
        
        
        // Mock processor
        $jp = $this->getMockBuilder('\Yuav\RestEncoderBundle\Processor\JobProcessor')
        ->disableOriginalConstructor()
        ->getMock();
        $jp->expects($this->once())->method('process')->will($this->throwException(new \RuntimeException));
        $consumer->setJobProcessor($jp);
        
        $result = $consumer->execute($jobQueueMsg);
        $this->assertFalse($result);
    }
    
    public function getJobProcessorMock()
    {
  
     
        return $jp;
    }
    
    /**
     * Workaround for MakeGood integration
     */
    protected static function createKernel(array $options = array()) {
        require_once realpath ( dirname ( __file__ ) . '/../../../../../../' ) . '/app/AppKernel.php';
    
        return new \AppKernel ( isset ( $options ['environment'] ) ? $options ['environment'] : 'test', isset ( $options ['debug'] ) ? $options ['debug'] : true );
    }
}