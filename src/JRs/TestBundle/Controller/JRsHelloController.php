<?php
namespace JRs\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class JRsHelloController extends Controller {

    public function indexAction($name){

        return $this->render('JRsTestBundle:JRsHello:index.html.twig',array('name'=>$name));

        //return new Response('<html><title>JR\'s Test Bundle</title><body>Hello, '
          //  .$name.'!</body></html>');
    }

} 