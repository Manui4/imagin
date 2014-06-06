<?php

namespace Man\Bundle\AdminBundle\Entity;

use Doctrine\Common\Persistence\ObjectManager;

interface ConfigurationManagerInterface
{
    /**
     * @param string $name
     * @param mixed $value
     *
     * @return \Man\Bundle\AdminBundle\Entity\ConfigurationManager
     */
    function set($name, $value);

    /**
     * @param string $name
     * 
     * @return mixed
     */
    function get($name);
}
