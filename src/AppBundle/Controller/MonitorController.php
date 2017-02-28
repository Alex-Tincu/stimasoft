<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\ResourceHistory;
use AppBundle\Repository\ResourceHistoryRepository;
use PHPHtmlParser\Dom;

class MonitorController extends Controller
{
    /**
     * @Route("Monitor/checkforchanges")
     */
    public function checkForChangesAction()
    {
        $ResourceRepository = $this->getDoctrine()->getRepository('AppBundle:Resource');
        $resources = $ResourceRepository->getAll();
        //$ResourceHistoryRepository = $this->getDoctrine()->getRepository('AppBundle:ResourceHistory');

        $dom = new Dom;
        $dom->setOptions([
            'strict' => false, // Set a global option to enable strict html parsing.
        ]);

        foreach ($resources as $resource){

            // get current content
            $dom->loadFromUrl($resource->getUrl());
            $content = $dom->find($resource->getCssRule());
            $html = (!empty($content)) ? $content->innerHtml : '';

            if($html != $resource->getLastHtml()) {

                // save actual content in resource table
                $resource->setLastHtml($html);
                $resource->setCheckDate(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->persist($resource);
                $em->flush();

                // save actual content in history
                $newValue = new resourceHistory();
                $newValue->setResource($resource);
                $newValue->setHtml($html);
                $newValue->setDate(new \DateTime());
                $newValue->setAlertSent(0);

                $em = $this->getDoctrine()->getManager();
                $em->persist($newValue);
                $em->flush();
            }
        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

}
