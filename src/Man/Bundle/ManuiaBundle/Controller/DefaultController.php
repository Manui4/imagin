<?php
namespace Man\Bundle\ManuiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('ManManuiaBundle:Default:index.html.twig');
    }

}
