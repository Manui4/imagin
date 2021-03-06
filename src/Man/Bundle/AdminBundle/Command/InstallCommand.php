<?php

namespace Man\Bundle\AdminBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper;

use Man\Bundle\AdminBundle\Entity\Configuration;

/**
 * Install website
 *
 * @author Thomas Tourlourat <thomas@tourlourat.com>
 */
class InstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('man:install')
            ->setDescription('Install man.')
            ->addOption(
                'default',
                'd',
                InputOption::VALUE_NONE,
                'Use default values'
            )
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configurationManager = $this->getContainer()->get('man_admin.manager.configuration');
        $dialog = $this->getDialogHelper();
        
        $explanationList = array(
            'blog.comment.enabled' => array(
                'question' => 'Do you want to enabled comment',
                'type' => 'boolean',
                'default' => false,
            ),
            'page.email' => array(
                'question' => 'Email',
                'type' => 'string',
                'default' => 'contact@man.com',
            ),
            'page.phone' => array(
                'question' => 'Phone number',
                'type' => 'number',
                'default' => '0984444464',
            ),
        );
        
        foreach($explanationList as $name => $explanation) {
            if($input->getOption('default')) {
                $configurationManager->set($name, $explanation['default']);
                continue;
            }

            switch($explanation['type']) {
                case 'boolean' : 
                    $value = $dialog->askConfirmation($output, $dialog->getQuestion($explanation['question'], 'yes', '?'), true);
                    break;
                default :
                    $value = $dialog->ask($output, $dialog->getQuestion($explanation['question'], null));
            }
            
            $configurationManager->set($name, $value);
        }
        
        $output->writeln('Man install done!');
    }
    
    protected function getDialogHelper()
    {
        $dialog = $this->getHelperSet()->get('dialog');
        if (!$dialog || get_class($dialog) !== 'Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper') {
            $this->getHelperSet()->set($dialog = new DialogHelper());
        }

        return $dialog;
    }
}