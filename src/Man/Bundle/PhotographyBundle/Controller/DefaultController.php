<?php
namespace Man\Bundle\PhotographyBundle\Controller;

use Man\Bundle\PhotographyBundle\Services\Flickr;
use Man\Bundle\PhotographyBundle\Services\Manager;

class DefaultController extends AbstractController
{

    public function indexAction()
    {
        $cache = $this->getCache();
        if($cache->contains('man_photography_flickr_pictures')){
            $pictures = $cache->fetch('man_photography_flickr_pictures');
        } else {
            /* @var $serviceManager Manager */
            $serviceManager = $this->get('man_photography.service.manager');
            $pictures = $serviceManager->getFlickrPictures();

            $cache->save('man_photography_flickr_pictures', $pictures);
        }

        return $this->render('ManPhotographyBundle:Default:index.html.twig', [
            'photosets' => $pictures
        ]);
    }

}
