<?php

namespace Man\Bundle\ManuiaBundle\Twig\Extension;

use Doctrine\Common\Inflector\Inflector;

class HtmlizeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('htmlize', array($this, 'htmlizeFilter')),
        );
    }


    function htmlizeFilter($inputString)
    {

        $inputString = $this->clickableUrls($inputString);
        $inputString = $this->rtAt($inputString);
        $inputString = $this->rtDiese($inputString);

        return $inputString;
    }

    /**
     * Transforme string into html string with @value wrappe.
     *
     * @param unknown $html
     */
    public function rtAt($html){
        return $result = preg_replace(
            '#(@[[:alnum:]*[:punct:]^:]*)#',
            '<b>$1</b>',
            $html
        );
    }

    /**
    * Transforme string into html string with @value wrappe.
    *
    * @param unknown $html
    */
    public function rtDiese($html){
        return $result = preg_replace(
            '@(#[[:alnum:]]*)\s*@',
            '<u>$1</u> ',
            $html
        );
    }

    /**
     * Transforme string into html string with clickable url.
     *
     * @param unknown $html
     */
    public function clickableUrls($html){
        return $result = preg_replace(
            '%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s',
            '<a href="$1">$1</a>',
            $html
        );
    }

    public function getName(){
        return 'Man_ManuiaBundle_Htmlize';
    }
}
