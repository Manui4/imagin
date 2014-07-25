<?php
namespace Man\Bundle\ManuiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class BlockController extends Controller
{

    public function selfiSliderAction()
    {
        $path = $this->container->getParameter('manuia_path_images_headshots');
        $webPath = $this->container->getParameter('manuia_path_web_images_headshots');


        $images = [];
        $finder = new Finder();
        $finder->files()->in($path);
        foreach ($finder as $file) {
            $images[] = $webPath . $file->getRelativePathname();
        }

        return $this->render('ManManuiaBundle:Block:selfi-slider.html.twig', [
            'images' => $images
        ]);
    }

    public function lastTweetsAction()
    {
        return $this->render('ManManuiaBundle:Block:last-tweets.html.twig', [

        ]);
    }

}
