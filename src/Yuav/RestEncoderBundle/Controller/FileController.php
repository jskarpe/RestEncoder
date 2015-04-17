<?php
namespace Yuav\RestEncoderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FileController extends Controller
{

    public function downloadAction($key)
    {
        $filepath = 'gaufrette://outputs/' . $key;
        
        $response = new Response();
        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $key);
        $response->headers->set('Content-Disposition', $d);
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Length', filesize($filepath));
        
        $response->sendHeaders();
        
        $out = fopen('php://output', 'wb');
        $file = fopen($filepath, 'rb');
        
        stream_copy_to_stream($file, $out);
        
        fclose($out);
        fclose($file);
    }
}