<?php

namespace Man\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Man\Bundle\AdminBundle\Form\Type\PostType;
use Man\Bundle\BlogBundle\Entity\Post;

use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/admin/post")
 */
class PostController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     * @Method({"GET"})
     * @Secure(roles="ROLE_ADMIN")
     */
    public function listAction()
    {
        $posts = $this->getPostRepository()->findAll();
        
        return array('posts' => $posts);
    }

    /**
     * @Route("/create")
     * @Template()
     * @Method({"GET", "POST"})
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction()
    {
        return $this->handleForm(new Post());
    }

    /**
     * @Route("/edit/{slug}")
     * @ParamConverter("post", class="ManBlogBundle:Post")
     * @Template()
     * @Method({"GET", "POST"})
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction(Post $post)
    {
        return $this->handleForm($post);
    }
    
    /**
     * @Route("/remove/{slug}")
     * @ParamConverter("post", class="ManBlogBundle:Post")
     * @Method({"DELETE"})
     * @Secure(roles="ROLE_ADMIN")
     */
    public function removeAction(Post $post)
    {
        $this->getPostManager()->delete($post);
        
        $this->getRequest()->getSession()->getFlashBag()->add('admin', sprintf('Post deleted: %s', $post->getSlug()));
        
        return $this->redirect($this->generateUrl('man_admin_post_list'));
    }
    
    protected function handleForm(Post $post)
    {
        $form = $this->createForm(new PostType(), $post);

        $request = $this->getRequest();
        
        if ('POST' === $request->getMethod()) {
            $form->submit($request);
            if ($form->isValid()) {
                $this->getPostManager()->add($post);
                
                $this->getRequest()->getSession()->getFlashBag()->add('admin', sprintf('Post update: %s', $post->getSlug()));
                
                $postUrl = $this->generateUrl('man_admin_post_list');
                
                return $this->redirect($postUrl);
            } else {
                $this->getRequest()->getSession()->getFlashBag()->add('admin', 'Form is not valid');
            }
        }
        
        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

    /**
     * @return \Man\Bundle\BlogBundle\Entity\PostRepository
     */
    protected function getPostRepository() 
    {
        return $this->get('man_blog.repository.post');
    }

    
    /**
     * @return \Man\Bundle\BlogBundle\Entity\PostManager
     */
    protected function getPostManager() 
    {
        return $this->get('man_blog.manager.post');
    }
}
