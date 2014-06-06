<?php

namespace Man\Bundle\AdminBundle\Form\Type;

use Man\Bundle\BlogBundle\Form\Type\PostType as PostTypeBase;


class PostType extends PostTypeBase
{
    public function getName()
    {
        return 'man_admin_post_type';
    }
}
