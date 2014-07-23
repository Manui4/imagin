<?php
namespace Man\Bundle\ManuiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $path = $this->container->getParameter('manuia_path_images_headshots');
        $webPath = $this->container->getParameter('manuia_path_web_images_headshots');
        $images = [];
        $finder = new Finder();
        $finder->files()->in($path);
        foreach ($finder as $file) {
            $images[] = $webPath . $file->getRelativePathname();
        }

        return $this->render('ManManuiaBundle:Default:index.html.twig', [
            'images' => $images
        ]);
    }

    public function testAction()
    {
        $path = $this->container->getParameter('manuia_path_images_headshots');
        $webPath = $this->container->getParameter('manuia_path_web_images_headshots');
        $images = [];
        $finder = new Finder();
        $finder->files()->in($path);
        foreach ($finder as $file) {
            $images[] = $webPath . $file->getRelativePathname();
        }

        return $this->render('ManManuiaBundle:Default:test.html.twig', [
            'images' => $images
        ]);
    }

}
