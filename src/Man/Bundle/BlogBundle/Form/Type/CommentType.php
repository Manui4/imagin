<?php
namespace Man\Bundle\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('username', null, array(
            'required' => true,
            'label' => 'Nom'
        ))
            ->add('email', null, array(
            'required' => true,
            'label' => 'Email'
        ))
            ->add('website', null, array(
            'required' => true,
            'label' => 'Site internet'
        ))
            ->add('content', 'textarea', array(
            'required' => true,
            'label' => 'Commentaire',
            'read_only' => false
        ))
            ->add('save', 'submit', array(
            'label' => 'Envoyer'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Man\Bundle\BlogBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'man_comment_type';
    }
}
