<?php

namespace Man\Bundle\PhotographyBundle\Common\Cache;

use Doctrine\Common\Cache\FilesystemCache as FSCache;

class FilesystemCache extends FSCache
{
    const MAN_EXTENSION = '.mancache.data';

    /**
     * {@inheritdoc}
     */
    protected $extension = self::MAN_EXTENSION;

}
