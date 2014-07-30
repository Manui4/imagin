<?php

namespace Man\Bundle\ManuiaBundle\Twig\Extension;

use Doctrine\Common\Inflector\Inflector;

class DecamelizeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('decamelize', array($this, 'decamelizeFilter')),
        );
    }


    function decamelizeFilter($inputString)
    {
        return Inflector::tableize($inputString);
    }


    public function getName(){
        return 'Man_ManuiaBundle_Decamelize';
    }
}
