<?php
namespace Man\Bundle\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Man\Bundle\BlogBundle\Entity\Post;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{

    public function findByPost(Post $post)
    {
        return $this->findBy(array(
            'post' => $post
        ));
    }

    public function findUnpublished()
    {
        return $this->findBy(array(
            'published' => false
        ));
    }
}
