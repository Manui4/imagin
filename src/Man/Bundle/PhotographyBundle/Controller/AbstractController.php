<?php
namespace Man\Bundle\PhotographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Man\Bundle\PhotographyBundle\Common\Cache\FilesystemCache;


/**
 * Abstract controller
 */
abstract class AbstractController extends Controller
{

    /**
     * Select the best cache
     */
    protected function getCache()
    {
        $cacheDirectory = $this->get('kernel')->getRootDir();
        $cacheDirectory .= '/cache/filecache';
        return new FilesystemCache($cacheDirectory);
    }
}