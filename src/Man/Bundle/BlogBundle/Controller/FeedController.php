<?php

namespace Man\Bundle\BlogBundle\Controller;

use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Man\Bundle\BlogBundle\Entity\Post;

class FeedController extends Controller
{
    /**
     * @Route("/feed/rss", name="man_blog_feed_rss", defaults={"_format" = "xml"})
     * @Method({"GET", "HEAD"})
     * @Cache(expires="+2 hours", public="true")
     */
    public function indexAction()
    {
        $postRepository = $this->getDoctrine()->getRepository('ManBlogBundle:Post');
        $postList = $postRepository->findPublished();

        $feed = new Feed();

        $channel = new Channel();
        $channel
            ->title("Imagin@tion\Man")
            ->description($this->get('translator')->trans('description'))
            ->url($this->generateUrl('man_blog', array(), UrlGeneratorInterface::ABSOLUTE_URL))
            ->appendTo($feed);

        foreach($postList as $post) {
            $item = new Item();
            $item
                ->title($post->getTitle())
                ->description($post->getDescription())
                ->pubDate($post->getModifiedAt()->getTimestamp())
                ->url($this->generateUrl('man_blog_post', array('slug' => $post->getSlug()), UrlGeneratorInterface::ABSOLUTE_URL))
                ->appendTo($channel);
        }

        return new Response($feed->render());
    }
}
