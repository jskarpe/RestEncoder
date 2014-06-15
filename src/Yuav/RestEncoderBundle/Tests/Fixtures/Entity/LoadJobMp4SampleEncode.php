<?php
namespace Yuav\RestEncoderBundle\Tests\Fixtures\Entity;

use Yuav\RestEncoderBundle\Entity\Job;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yuav\RestEncoderBundle\Entity\Output;

class LoadJobMp4SampleEncode implements FixtureInterface
{
	static public $jobs = array();

	public function load(ObjectManager $manager)
	{
		$job = new Job();
		$job->setInput('http://vjs.zencdn.net/v/oceans.mp4');
		$job->setApiKey('dummy');
		
		$output = new Output();
		$output->setUrl('http://upload_file_here');
		$job->addOutput($output);

		$manager->persist($job);
		$manager->flush();

		self::$jobs[] = $job;
	}
}
