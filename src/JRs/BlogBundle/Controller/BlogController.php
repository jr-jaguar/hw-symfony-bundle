<?php

namespace JRs\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller {
    public function showAction($id){
        $em=$this->getDoctrine()->getManager();
        $blog=$em->getRepository('JRsBlogBundle:Blog')->find($id);
        if (!$blog){
            throw $this->createNotFoundException('Not Found blog\'s message');
        }
        return $this->render('JRsBlogBundle:Blog:show.html.twig', array(
            'blog'=>$blog,
        ));
    }
} 