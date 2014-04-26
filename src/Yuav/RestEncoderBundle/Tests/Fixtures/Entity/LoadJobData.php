<?php
namespace Yuav\RestEncoderBundle\Tests\Fixtures\Entity;

use Yuav\RestEncoderBundle\Entity\Job;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadJobData implements FixtureInterface
{
	static public $jobs = array();

	public function load(ObjectManager $manager)
	{
		$job = new Job();
		$job->setState('finished');
		$job->setCreatedAt(new \DateTime('now'));

		$manager->persist($job);
		$manager->flush();

		self::$jobs[] = $job;
	}
}
