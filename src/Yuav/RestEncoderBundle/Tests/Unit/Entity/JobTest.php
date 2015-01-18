<?php
namespace Yuav\RestEncoderBundle\Tests\Unit\Entity;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Entity\Output;
use Yuav\RestEncoderBundle\Entity\Input;

class JobTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculateProgress()
    {
        $job = new Job();
        $input = new Input();
        $job->setInput($input);
        $output = new Output();
        $job->addOutput($output);
        
        $job->calculateProgress();
        $this->assertEquals(0, $job->getProgress());
        
        $input->setCurrentEvent('Analyzing');
        $this->assertEquals('Analyzing', $input->getCurrentEvent());
        $input->setCurrentEventProgress(100);
        $input->calculateProgress();
        $this->assertEquals(100, $input->getProgress());
        $output->setCurrentEvent('Uploading');
        $output->setCurrentEventProgress(100);
        $output->calculateProgress();
        $this->assertEquals(100, $output->getProgress());
        
        // Everything but thumbnails done
        $job->calculateProgress();
        $this->assertEquals(90, $job->getProgress());
    }
}
