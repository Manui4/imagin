<?php
namespace Man\Bundle\PhotographyBundle\Command;

use Monolog\Logger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


/**
 *
 * @author mantoine
 *
 */
class OAuthFlickerCommand extends ContainerAwareCommand
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
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('man:flickr:getToken')
            ->setDescription('Get oauth token for flikr api')
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

    }

    /**
     *
     * @param unknown_type $message
     */
    private function _logInfo($message)
    {
        $this->logger->info($message);
        $this->output->writeln('<info>[INFO]</info> ' . $message);
    }

    /**
     *
     * @param unknown_type $message
     */
    private function _logError($message)
    {
        $this->logger->error($message);
        $this->output->writeln('<error>[ERROR]</error> ' . $message);
    }
}