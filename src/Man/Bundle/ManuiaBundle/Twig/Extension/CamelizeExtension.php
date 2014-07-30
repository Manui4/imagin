<?php

namespace Man\Bundle\ManuiaBundle\Twig\Extension;

use Doctrine\Common\Inflector\Inflector;

class CamelizeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('camelize', array($this, 'camelizeFilter')),
        );
    }


    function camelizeFilter($inputString)
    {
        return Inflector::classify($inputString);
    }


    public function getName(){
        return 'Man_ManuiaBundle_Camelize';
    }
}
