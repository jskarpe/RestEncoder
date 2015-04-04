<?php
namespace Yuav\RestEncoderBundle\Tests\Handler;

require_once dirname(__DIR__).'/../../../../../app/AppKernel.php';

use Yuav\RestEncoderBundle\Handler\JobHandler;
use Yuav\RestEncoderBundle\Model\JobInterface;
use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Processor\OutputProcessor;
use FFMpeg\FFMpeg;

class OutputProcessorTest extends \PHPUnit_Framework_TestCase
{

    const JOB_CLASS = 'Yuav\RestEncoderBundle\Tests\Handler\DummyJob';

    /**
     *
     * @var JobHandler
     */
    protected $jobHandler;

    /**
     *
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $om;

    /**
     *
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $repository;

    protected $kernel;
    
    protected $container;
    
    public function setUp()
    {
        if (! interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $this->kernel = new \AppKernel('test', true);
        $this->kernel->boot();
        $this->container = $this->kernel->getContainer();
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');
        
        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::JOB_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::JOB_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::JOB_CLASS));
    }

    public function testUpload()
    {
        $ffmpeg = $this->getMock('FFMpeg\FFMpeg', array(
            'read'
        ), array(), 'FFMpegMock', FALSE);
        
        $fs = $this->container->get('knp_gaufrette.filesystem_map');
        
        $outputProcessor = new OutputProcessor($this->om, $ffmpeg, $fs);
        
        $outputProcessor->upload('testfile', 'file_contents');
    }
}