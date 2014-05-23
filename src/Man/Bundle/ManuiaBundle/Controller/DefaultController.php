<?php

namespace Man\Bundle\ManuiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ManManuiaBundle:Default:index.html.twig');
    }

    public function helloAction($name)
    {
        return $this->render('ManManuiaBundle:Default:hello.html.twig', array('name' => $name));
    }
}
