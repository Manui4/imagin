<?php

namespace Man\Bundle\BlogBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for creating new post.
 *
 * @author Thomas Tourlourat <thomas@tourlourat.com>
 */
class PostDeleteCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('blog:post:delete')
            ->setDescription('Publish a post.')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $post = $this->getPost($input, $output);
        
        if(!$post) {
            return 1;
        }
        
        $dialog = $this->getDialogHelper();
        
        if (!$dialog->askConfirmation($output, $dialog->getQuestion('Do you confirm post suppresion', 'yes', '?'), true)) {
            return 1;
        }
        
        $this->getPostManager()->delete($post);
        
        $output->writeln('done!');
    }
}