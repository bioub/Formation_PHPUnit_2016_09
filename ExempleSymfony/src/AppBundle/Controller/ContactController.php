<?php

namespace AppBundle\Controller;

use AppBundle\Manager\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/contacts")
 */
class ContactController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Contact');

        $contacts = $repo->findAll();

        return $this->render('AppBundle:Contact:list.html.twig', array(
            'contacts' => $contacts
        ));
    }

    /**
     * @Route("/list-avec-manager")
     */
    public function listAvecManagerAction()
    {

       // $em = $this->get('doctrine.orm.default_entity_manager');
       // $contactManager = new ContactManager($em);
        $contactManager = $this->get('app.manager.contact');
        $contacts = $contactManager->findAll();

        return $this->render('AppBundle:Contact:list.html.twig', array(
            'contacts' => $contacts
        ));
    }

    /**
     * @Route("/{id}")
     */
    public function showAction($id)
    {
        return new Response();
    }
}
