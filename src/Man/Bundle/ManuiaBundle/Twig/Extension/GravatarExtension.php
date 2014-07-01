<?php

namespace Man\Bundle\ManuiaBundle\Twig\Extension;

class GravatarExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('gravatar', array($this, 'gravatarFilter')),
        );
    }


    function gravatarFilter($mail)
    {
        return '//1.gravatar.com/avatar/' . md5($mail) . '?s=100';
    }


    public function getName(){
        return 'Man_ManuiaBundle_Gravatar';
    }
}