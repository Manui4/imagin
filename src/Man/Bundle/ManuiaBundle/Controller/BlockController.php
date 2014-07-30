<?php
namespace Man\Bundle\ManuiaBundle\Controller;

use Symfony\Component\Finder\Finder;
use Man\Bundle\ManuiaBundle\Services\Twitter;

class BlockController extends AbstractController
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
        $cache = $this->getCache();
        if ($cache->contains('man_photography_twitter_tweets')) {
            $tweets = $cache->fetch('man_photography_twitter_tweets');
        } else {
            /* @var $serviceTwitter Twitter */
            $serviceTwitter = $this->get('man_manuia.service.twitter');
            $tweets = $serviceTwitter->getUserTimeline();
            $cache->save('man_photography_twitter_tweets', $tweets, 60);
        }

        return $this->render('ManManuiaBundle:Block:last-tweets.html.twig', [
            'tweets' => $tweets
        ]);
    }
}
