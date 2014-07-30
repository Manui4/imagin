<?php
namespace Man\Bundle\ManuiaBundle\Twig\Extension;

use Doctrine\Common\Inflector\Inflector;

class FlickrDescriptionExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('flickr_desc', array(
                $this,
                'flickrDescFilter'
            ))
        );
    }

    function flickrDescFilter($value)
    {
        $return = '';
        if (is_array($value)) {
            foreach ($value as $data) {
                $return .= $data;
            }
        } else {
            $return = $value;
        }
        return $return;
    }

    public function getName()
    {
        return 'Man_ManuiaBundle_FlickrDesc';
    }
}
