<?php

namespace JRs\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JRs\BlogBundle\Entity\Enquiry;
use JRs\BlogBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class PageController extends Controller {
    public function indexAction(){
        $em=$this->getDoctrine()->getManager();
        $blogs=$em->getRepository('JRsBlogBundle:Blog')->getLatestBlogs();

        return $this->render('JRsBlogBundle:Page:index.html.twig', array('blogs'=>$blogs));
    }
    public function aboutAction(){
        return $this->render('JRsBlogBundle:Page:about.html.twig');
    }



    public function contactAction(Request $request){
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(),$enquiry);
        //$request = $this->getRequest();
        if ($request->getMethod()=='POST'){
            $form->handleRequest($request);
            if ($form->isValid()){
                $message = \Swift_Message::newInstance()
                ->setSubject('Contact enquery from blog')
                ->setFrom('enqueries@jrsblog')
                ->setTo($this->container->getParameter('jrs_blog.emails.contact_email'))
                ->setBody($this->renderView('JRsBlogBundle:Page:contactEmail.txt.twig',array('enquiry'=>$enquiry)));
                $this->get('mailer')->send($message);
                $request->getSession()->getFlashBag()->add(
                    'notice','Vash zapros otpravlen');
                return $this->redirect($this->generateUrl('JRsBlogBundle_contact'));
            }
        }

        return $this->render('JRsBlogBundle:Page:contact.html.twig',array('form'=>$form->createView()));
    }


}