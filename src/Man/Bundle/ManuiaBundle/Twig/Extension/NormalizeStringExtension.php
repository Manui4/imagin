<?php

namespace Man\Bundle\ManuiaBundle\Twig\Extension;

use Doctrine\Common\Inflector\Inflector;

class NormalizeStringExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('normalize_string', array($this, 'normalizeStringFilter')),
        );
    }


    function normalizeStringFilter($inputString)
    {
        $inputString = str_replace("'", " ", $inputString);
        $inputString = str_replace(".", " ", $inputString);
        return $inputString;
    }


    public function getName(){
        return 'Man_ManuiaBundle_NormalizeString';
    }
}
