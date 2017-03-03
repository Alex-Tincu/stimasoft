<?php
// src/AppBundle/Command/CheckForUpdatesCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use AppBundle\Entity\ResourceHistory;
use PHPHtmlParser\Dom;

class CheckForUpdatesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        // the name of the command (the part after "bin/console")
        $this->setName('app:check-for-updates');

        // the short description shown while running "php bin/console list"
        $this->setDescription('Parse urls and record changes.');

        // the full command description shown when running the command with
        // the "--help" option
        $this->setHelp('Parse urls and record changes.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $ResourceRepository = $doctrine->getRepository('AppBundle:Resource');
        $resources = $ResourceRepository->getAll();
        //$ResourceHistoryRepository = $this->getDoctrine()->getRepository('AppBundle:ResourceHistory');

        $dom = new Dom;
        $dom->setOptions([
            'strict' => false, // Set a global option to enable strict html parsing.
        ]);

        $nrChanges = 0;

        foreach ($resources as $resource){

            // get current content
            $dom->loadFromUrl($resource->getUrl());
            $content = $dom->find($resource->getCssRule());
            $currentHtml = (!empty($content)) ? $content->innerHtml : '';
            $newHtml = $resource->getNewHtml();
            $oldHtml = $resource->getOldHtml();

            if($currentHtml && $currentHtml != $newHtml) {

                $resource->setNewHtml($currentHtml);
                $resource->setOldHtml($newHtml);
                $resource->setCheckDate(new \DateTime());
                if(!$newHtml){
                    // este prima parsare, nu trimit alerta
                    $resource->setAlertSent(1);
                }else{
                    // resetez flagul pentru a alerta noua modificare
                    $resource->setAlertSent(0);
                }

                $em = $doctrine->getManager();
                $em->persist($resource);
                $em->flush();

                $newValue = new resourceHistory();
                $newValue->setResource($resource);
                $newValue->setHtml($currentHtml);
                $newValue->setDate(new \DateTime());

                $em = $doctrine->getManager();
                $em->persist($newValue);
                $em->flush();

                $nrChanges++;
            }
        }

        $output->writeln("$nrChanges changes was made");
    }
}