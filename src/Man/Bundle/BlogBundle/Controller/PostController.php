<?php

namespace Man\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Man\Bundle\BlogBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/blog", name="man_blog", options={"sitemap" = true})
     * @Method({"GET", "HEAD"})
     * @Cache(expires="+2 hours", public="true")
     * @Template()
     */
    public function indexAction()
    {
        $postRepository = $this->getDoctrine()->getRepository('ManBlogBundle:Post');

        return array(
            'posts' => $postRepository->findPublished()
        );
    }

    /**
     * @Route("/blog/{slug}", name="man_blog_post", options={"sitemap" = true})
     * @ParamConverter("post", class="ManBlogBundle:Post")
     * @Method({"GET", "HEAD"})
     * @Cache(expires="+2 hours", public="true")
     * @Template()
     */
    public function postAction(Post $post)
    {
        $comments = $this->getDoctrine()->getRepository('ManBlogBundle:Comment')->findByPost($post);

        // TODO
        $post_content = str_replace('{{ site.url }}', 'http://localhost/Man\Bundle/bundles/manblog/', $post->getContent());

        return array(
            'post' => $post,
            'post_description' => $post->getDescription(),
            'post_content' => $post_content,
            'comments' => $comments,
        );
    }

    /**
     *
     * @return \Man\Bundle\BlogBundle\Entity\CommentManager
     */
    protected function getCommentManager()
    {
        return $this->get('man_blog.manager.comment');
    }
}
