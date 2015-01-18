<?php
namespace Yuav\RestEncoderBundle\Tests\Functional\Processor;

use Yuav\RestEncoderBundle\Processor\Input\Downloader;

class InputTest extends \PHPUnit_Framework_TestCase
{

    public function testDownloadProgress()
    {
        $downloader = new Downloader();
        $file = $downloader->download('https://www.google.no/images/srpr/logo11w.png');
        $this->assertFileExists($file);
        unlink($file);
        
        $mock = $this->getMock('\Yuav\RestEncoder\Processor\JobProcessor', array(
            'updateDownloadProgress'
        ));
        $mock->expects($this->atLeastOnce())
            ->method('updateDownloadProgress');
        $file = $downloader->download('https://www.google.no/images/srpr/logo11w.png', array(
            $mock,
            'updateDownloadProgress'
        ));
    }
    
    // public function progressCallback($ch, $download_size, $downloaded, $upload_size, $uploaded)
    // {
    // var_dump($download_size, $downloaded);
    // }
}