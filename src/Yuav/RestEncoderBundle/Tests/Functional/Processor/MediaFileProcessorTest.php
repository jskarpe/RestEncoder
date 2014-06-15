<?php
namespace Yuav\RestEncoderBundle\Tests\Functional\Encoder;

use Yuav\RestEncoderBundle\Entity\Job;
use Yuav\RestEncoderBundle\Processor\MediaFileProcessor;

class InputHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testGenerateMediaFile()
    {
        $url = 'http://fqdn/video_test.mp4';
        $inputFile = realpath(__DIR__ . '/../../Files/video_test.mp4');
        
        $job = new Job();
        $job->setInput($url);
        
        $mediaFileProcessor = new MediaFileProcessor();
        $mediaFile = $mediaFileProcessor->process($inputFile);
        
        $this->assertInstanceOf('\Yuav\RestEncoderBundle\Entity\MediaFile', $mediaFile);
        $this->assertEquals('mov,mp4,m4a,3gp,3g2,mj2', $mediaFile->getFormat());
        $this->assertEquals(16226.667, $mediaFile->getDurationInMs());
        $this->assertEquals(44100, $mediaFile->getAudioSampleRate());
        $this->assertEquals('9261a48565e788140fe01299efe50e10', $mediaFile->getMd5Checksum());
    }
}

