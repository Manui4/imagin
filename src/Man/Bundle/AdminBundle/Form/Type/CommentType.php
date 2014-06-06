<?php

namespace Man\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

use Man\Bundle\BlogBundle\Form\Type\CommentType as CommentTypeBase;

class CommentType extends CommentTypeBase
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('published', 'checkbox', array(
                'required' => false,
                'label' => 'Published'
            ))
            ->add('save', 'submit', array('label' => 'Save'))
        ;
    }
    
    public function getName()
    {
        return 'man_admin_comment_type';
    }
}
