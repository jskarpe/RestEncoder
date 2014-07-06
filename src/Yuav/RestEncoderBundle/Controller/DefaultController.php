<?php
namespace Yuav\RestEncoderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $name = 'asdf2';
        
        $content = $this->renderView('YuavRestEncoderBundle:RequestBuilder:index.html.twig', array(
            'name' => $name
        ));
        
        return new Response($content);
    }
}


