<?php
namespace Man\Bundle\PhotographyBundle\Command;

use Monolog\Logger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Man\Bundle\PhotographyBundle\Common\Cache\FilesystemCache;


/**
 *
 * @author mantoine
 *
 */
abstract class AbstractCommand extends ContainerAwareCommand
{
    /**
     *
     * @var Logger $_logger
     */
    protected $logger;

    /**
     *
     * @var OutputInterface $output
     */
    protected $output;

    /**
     *
     * @param unknown_type $message
     */
    protected function _logInfo($message)
    {
        $this->logger->info($message);
        $this->output->writeln('<info>[INFO]</info> ' . $message);
    }

    /**
     *
     * @param unknown_type $message
     */
    protected function _logError($message)
    {
        $this->logger->error($message);
        $this->output->writeln('<error>[ERROR]</error> ' . $message);
    }

    /**
     * Select the best cache
     */
    protected function getCache()
    {
        $cacheDirectory = $this->getContainer()->get('kernel')->getRootDir();
        $cacheDirectory .= '/cache/filecache';
        return new FilesystemCache($cacheDirectory);
    }
}