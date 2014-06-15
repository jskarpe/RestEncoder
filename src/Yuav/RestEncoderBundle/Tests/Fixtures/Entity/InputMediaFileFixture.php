<?php
namespace Yuav\RestEncoderBundle\Tests\Fixtures\Entity;

use Yuav\RestEncoderBundle\Entity\MediaFile;

class InputMediaFileFixture extends MediaFile
{
	public function __construct()
	{
	    $this->setUrl('http://fqdn/test_file.mp4');
	    $this->setWidth(720);
	    $this->setHeight(576);
	    
	}
}
