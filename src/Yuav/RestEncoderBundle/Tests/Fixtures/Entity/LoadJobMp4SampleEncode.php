<?php
namespace Yuav\RestEncoderBundle\Tests\Fixtures\Entity;

use Yuav\RestEncoderBundle\Entity\Job;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Entity\Input;

class LoadJobMp4SampleEncode implements FixtureInterface
{
	static public $jobs = array();

	public function load(ObjectManager $manager)
	{
		$job = new Job();
		$input = new Input();
		$input->setUri('http://vjs.zencdn.net/v/oceans.mp4');
		$job->setInput($input);
		$job->setApiKey('dummy');
		
		$output = new Output();
		$output->setUrl('http://upload_file_here');
		$job->addOutput($output);

		$manager->persist($job);
		$manager->flush();

		self::$jobs[] = $job;
	}
}
