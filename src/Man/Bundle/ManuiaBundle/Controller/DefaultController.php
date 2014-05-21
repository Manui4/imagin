<?php

namespace Man\Bundle\ManuiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ManManuiaBundle:Default:index.html.twig', array('name' => $name));
    }
}
