<?php
namespace Yuav\RestEncoderBundle\Tests\Fixtures\Entity;

use Yuav\RestEncoderBundle\Entity\Job;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yuav\RestEncoderBundle\Entity\Input;
use Proxies\__CG__\Yuav\RestEncoderBundle\Entity\Output;

class LoadJobData implements FixtureInterface
{
	static public $jobs = array();

	public function load(ObjectManager $manager)
	{
		$job = new Job();
		$input = new Input();
		$input->setUri('http://myFileHere.com/file.mpg');
		$job->setInput($input);
		$job->setApiKey('dummy');
		
		$output = new Output();
		$job->addOutput($output);

		$manager->persist($job);
		$manager->flush();

		self::$jobs[] = $job;
	}
}
