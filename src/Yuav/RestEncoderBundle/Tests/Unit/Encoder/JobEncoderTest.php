<?php
// namespace Yuav\RestEncoderBundle\Tests\Handler;
// use Yuav\RestEncoderBundle\Handler\JobHandler;
// use Yuav\RestEncoderBundle\Model\JobInterface;
// use Yuav\RestEncoderBundle\Entity\Job;
// use Yuav\RestEncoderBundle\Encoder\JobEncoder;
// use Yuav\RestEncoderBundle\Tests\Fixtures\Entity\InputMediaFileFixture;

// class JobEncoderTest extends \PHPUnit_Framework_TestCase
// {

//     const MEDIAFILE_CLASS = 'Yuav\RestEncoderBundle\Tests\Fixtures\Entity\InputMediaFileFixture';

//     public function testEncode()
//     {
//         $job = new Job();
//         $job->setInput('http://fqdn/test_video.mp4');
        
//         $jobEncoder = new JobEncoder($this->getInputHandlerMock(), $this->getOutputHandlerMock());
//         $jobEncoder->processJob($job);
//     }
    
//     public function getInputHandlerMock()
//     {
//         $inputHandlerMock = $this->getMock('\Yuav\RestEncoderBundle\Encoder\InputHandler');
//         $inputFile = realpath(__DIR__.'/../../Files/test_file.mp4');
//         $inputHandlerMock->expects($this->any())->method('downloadAdvanced')->will($this->returnValue($inputFile));
//         $inputHandlerMock->expects($this->any())->method('generateMediaFile')->will($this->returnValue(new InputMediaFileFixture()));
//         return $inputHandlerMock;        
//     }
    
//     public function getOutputHandlerMock()
//     {
//         $outputHandlerMock = $this->getMock('\Yuav\RestEncoderBundle\Encoder\OutputHandler');
//         $outputFile = realpath(__DIR__.'/../../Files/test_file.mp4');
//         $outputHandlerMock->expects($this->any())->method('encode')->will($this->returnValue($outputFile));
        
//         return $outputHandlerMock;
//     }
// }
