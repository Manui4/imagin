<?php

namespace Man\Bundle\PhotographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ManPhotographyBundle:Default:index.html.twig', []);
    }
}
