<?php
namespace Yuav\RestEncoderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Yuav\RestEncoderBundle\Entity\Job;

class IndexController extends Controller
{

    public function indexAction()
    {
        $entityManager = $this->container->get('doctrine.orm.entity_manager');
        
        $dql = "SELECT j FROM \Yuav\RestEncoderBundle\Entity\Job j";
        $query = $entityManager->createQuery($dql)
            ->setFirstResult(0)
            ->setMaxResults(100);
        
        $jobs = new Paginator($query, $fetchJoinCollection = true);
        
        $dql = "SELECT o FROM \Yuav\RestEncoderBundle\Entity\Output o";
        $query = $entityManager->createQuery($dql)
            ->setFirstResult(0)
            ->setMaxResults(100);
        
        $outputs = new Paginator($query, $fetchJoinCollection = true);
        
        return $this->render('YuavRestEncoderBundle:Index:index.html.twig', array(
            'jobs' => $jobs,
            'outputs' => $outputs
        ));
    }

    public function requestBuilderAction()
    {
        $name = 'asdf2';
        
        $content = $this->renderView('YuavRestEncoderBundle:RequestBuilder:index.html.twig', array(
            'name' => $name
        ));
        
        return new Response($content);
    }
}


