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
		$job->setInput('http://myFileHere.com/file.mpg');
		$job->setApiKey('dummy');
// 		$job->setSubmittedAt(new \DateTime('now'));
// 		$job->setUpdatedAt(new \DateTime('now'));

		$manager->persist($job);
		$manager->flush();

		self::$jobs[] = $job;
	}
}
