<?php
namespace Yuav\RestEncoderBundle\Tests\Unit\Entity;

use Yuav\RestEncoderBundle\Entity\Input;

class InputTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculateProgress()
    {
        $input = new Input();
        $input->setCurrentEvent('Downloading'); // 90% of total
        $input->setCurrentEventProgress(90);
        
        $expectedProgress = 90 * 90 / 100;
        $this->assertEquals($expectedProgress, $input->getProgress());
    }
}
