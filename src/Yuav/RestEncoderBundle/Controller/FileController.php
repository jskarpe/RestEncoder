<?php
namespace Yuav\RestEncoderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{

    public function downloadAction($key)
    {
        $filepath = 'gaufrette://outputs/'.$key;
        $response = new BinaryFileResponse($filepath);
        return $response;
    }    
}