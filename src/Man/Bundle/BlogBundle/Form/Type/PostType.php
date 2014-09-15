<?php

namespace Man\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'Titre'
            ))
            ->add('slug', 'text', array(
                'required' => true,
                'label' => 'Slug'
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => 'Description'
            ))
            ->add('published', 'checkbox', array(
                'required' => false,
                'label' => 'Mettre en ligne ?'
            ))
            ->add('content', 'textarea', array(
                'required' => false,
                'label' => 'Contenu',
            ))
            ->add('save', 'submit', array('label' => 'Save'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Man\Bundle\BlogBundle\Entity\Post',
        ));
    }

    public function getName()
    {
        return 'man_post_type';
    }
}
