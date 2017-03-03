<?php
// src/AppBundle/Command/SendAlertsCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use AppBundle\Entity\ResourceHistory;
//use AppBundle\Repository\ResourceHistoryRepository;

class SendAlertsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        // the name of the command (the part after "bin/console")
        $this->setName('app:send-alerts');

        // the short description shown while running "php bin/console list"
        $this->setDescription('Send email alerts when changes occur.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        //$ResourceRepository = $doctrine->getRepository('AppBundle:Resource');
        //$resources = $ResourceRepository->getAll();

        $ResourceRepository = $doctrine->getRepository('AppBundle:Resource');
        $resources = $ResourceRepository->getResourcesChanged();

        foreach ($resources as $resource){
            $alertHtml = $resource->getAlertHtml();
            if(is_numeric($alertHtml) && $resource->getNewHtml() < $alertHtml) {
                // send email
            }
        }

        //$output->writeln("$nrChanges changes was made");
    }
}