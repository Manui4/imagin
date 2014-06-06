<?php

namespace Man\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Man\Bundle\BlogBundle\Entity\Post;
use Man\Bundle\BlogBundle\Form\Type\CommentType;

class CommentController extends Controller
{
    /**
     * @Route("/blog/{slug}/comment", name="man_blog_add_comment")
     * @ParamConverter("post", class="ManBlogBundle:Post")
     * @Template()
     * @Method({"POST"})
     */
    public function addAction(Post $post)
    {
        if(!$this->getConfigurationManager()->get('blog.comment.enabled')) {
            throw new UnauthorizedHttpException('Comments are disabled');
        }

        $comment = $this->getCommentManager()->build($post);

        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('man_blog_add_comment', array('slug' => $comment->getPost()->getSlug())),
        ));

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->submit($request);
            if ($form->isValid()) {
                $this->getCommentManager()->add($comment);

                $request->getSession()->getFlashBag()->add('comments', 'Your comment will be publish as soon as possible. Waiting for approbation.');

                $postUrl = $this->generateUrl('man_blog_post', array('slug' => $post->getSlug()));

                return $this->redirect($postUrl . "#comments");
            } else {
                $request->getSession()->getFlashBag()->add('comments', 'Please check filled information');
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/blog/{slug}/comments")
     * @ParamConverter("post", class="ManBlogBundle:Post")
     * @Template()
     * @Method({"GET"})
     */
    public function listAction(Post $post)
    {
        if(!$this->getConfigurationManager()->get('blog.comment.enabled')) {
            throw new UnauthorizedHttpException('Comments are disabled');
        }

        $comments = $this->getDoctrine()->getRepository('ManBlogBundle:Comment')->findByPost($post);

        return array(
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

    /**
     * @return \Man\Bundle\AdminBundle\Entity\ConfigurationManager
     */
    private function getConfigurationManager()
    {
        return $this->container->get('man_admin.manager.configuration');
    }
}
