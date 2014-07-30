<?php
namespace Man\Bundle\PhotographyBundle\Command;

use Monolog\Logger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Man\Bundle\PhotographyBundle\Services\Manager;

/**
 *
 * @author mantoine
 *
 */
class UpdateFlickrCacheCommand extends AbstractCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('man:flickr:cache:update')
            ->setDescription('Update Flickr cache')
        ;
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input
     *            An InputInterface instance
     * @param OutputInterface $output
     *            An OutputInterface instance
     *
     * @return null integer or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->logger = $this->getContainer()->get('logger');
        $this->output = $output;

        if (! $this->getContainer()->has('man_photography.service.manager')) {
            throw new \LogicException('The man_photography.service.manager is not registered in your application.');
        }
        $cache = $this->getCache();

        /* @var $serviceManager Manager */
        $serviceManager = $this->getContainer()->get('man_photography.service.manager');

        $this->_logInfo("Get all pictures information from Flickr..");
        $pictures = $serviceManager->getFlickrPictures();

        $this->_logInfo("Save data in cache..");
        $cache->save('man_photography_flickr_pictures', $pictures);

        $this->_logInfo("ok, it's good.");
    }

}