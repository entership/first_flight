<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LaunchParserCommand
 * @package Korobochkin\CoppermineGalleryParserBundle\Command
 */
class LaunchParserCommand extends ContainerAwareCommand {
    public function configure()
    {
        $this
            ->setName('coppermine_parser:parse')
            ->setDescription('Grab photos from Coppermine gallery')
            ->setHelp('Specify URL of an album and you are done')
            ->addArgument(
                'url',
                InputArgument::REQUIRED,
                'URL to parse'
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $parser = $this->getContainer()->get('coppermine_parser.parser');
        $parser->parse($input->getArgument('url'));
    }
}
