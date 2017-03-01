<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Resource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends Controller
{
    /**
     * @Route("user/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('user_list_resources');
    }

    /**
     * @Route("user/list_resources", name="user_list_resource")
     */
    public function listResourcesAction()
    {

        $data = [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ];

        $resourceRepository = $this->getDoctrine()->getRepository('AppBundle:Resource');
        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');

        $data['user'] = $userRepository->find(1);
        $data['resources'] = $resourceRepository->getUserResources($data['user']);

        return $this->render('user/list_resources.html.twig', $data);
    }

    /**
     * @Route("user/edit_resource/{resourceId}", name="user_edit_resource", requirements={"resourceId": "\d+"})
     */
    public function editResourceAction($resourceId = 0, Request $request)
    {
        $data = [];
        $resourceRepository = $this->getDoctrine()->getRepository('AppBundle:Resource');
        $data['resource'] = $resourceRepository->find($resourceId);

        if(empty($data['resource'])){
            $data['resource'] = new Resource();
        }

        $form = $this->createFormBuilder($data['resource'])
            ->add('url', TextType::class)
            ->add('css_rule', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data['resource'] = $form->getData();
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->find(1);
            $data['resource']->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($data['resource']);
            $em->flush();

            return $this->redirectToRoute('user_list_resources');
        }

        $data['form'] = $form->createView();

        return $this->render('user/edit_resource.html.twig', $data);
    }

    /**
     * @Route("user/view_resource_history/{resourceId}", name="user_view_resource_history", requirements={"resourceId": "\d+"})
     */
    public function viewResourceHistoryAction($resourceId)
    {
        $resourceHistoryRepository = $this->getDoctrine()->getRepository('AppBundle:ResourceHistory');
        $resourceRepository = $this->getDoctrine()->getRepository('AppBundle:Resource');

        $data['resource'] = $resourceRepository->find($resourceId);
        $data['changes'] = $resourceHistoryRepository->getHistory($data['resource']);

        return $this->render('user/view_resource_history.html.twig', $data);
    }

    /**
     * @Route("user/delete_resource/{resourceId}", name="user_delete_resource", requirements={"resourceId": "\d+"})
     */
    public function deleteResourceAction($resourceId = 0)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find(1);

        $resourceRepository = $this->getDoctrine()->getRepository('AppBundle:Resource');
        $resourceRepository->deleteResource($resourceId, $user);

        return $this->redirectToRoute('user_list_resources');
    }
}
