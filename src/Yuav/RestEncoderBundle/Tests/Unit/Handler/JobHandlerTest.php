<?php

namespace Yuav\RestEncoderBundle\Tests\Handler;
use Yuav\RestEncoderBundle\Handler\JobHandler;
use Yuav\RestEncoderBundle\Model\JobInterface;
use Yuav\RestEncoderBundle\Entity\Job;

class JobHandlerTest extends \PHPUnit_Framework_TestCase
{


	const JOB_CLASS = 'Yuav\RestEncoderBundle\Tests\Handler\DummyJob';

	/** @var JobHandler */
	protected $jobHandler;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $om;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $repository;

	public function setUp()
	{
		if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
			$this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
		}

		$class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
		$this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
		$this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
		$this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

		$this->om->expects($this->any())->method('getRepository')->with($this->equalTo(static::JOB_CLASS))
				->will($this->returnValue($this->repository));
		$this->om->expects($this->any())->method('getClassMetadata')->with($this->equalTo(static::JOB_CLASS))
				->will($this->returnValue($class));
		$class->expects($this->any())->method('getName')->will($this->returnValue(static::JOB_CLASS));
	}

	public function testGet()
	{
		$id = 1;
		$page = $this->getJob();
		$this->repository->expects($this->once())->method('find')->with($this->equalTo($id))
				->will($this->returnValue($page));

		$this->pageHandler = $this->createJobHandler($this->om, static::JOB_CLASS, $this->formFactory);

		$this->pageHandler->get($id);
	}

	protected function getJob()
	{
		$jobClass = static::JOB_CLASS;

		return new $jobClass();
	}

	protected function createJobHandler($objectManager, $jobClass, $formFactory)
	{
		return new JobHandler($objectManager, $jobClass, $formFactory);
	}

}

class DummyJob extends Job
{
}
