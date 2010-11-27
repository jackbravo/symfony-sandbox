<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\Contact;
use Application\ChiaBundle\Form\ContactForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactsController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $contacts = $em->createQuery('SELECT c FROM ChiaBundle:Contact c')->getArrayResult();
        return $this->render('ChiaBundle:Contacts:index.twig', array('contacts' => $contacts));
    }

    public function newAction()
    {
        $contact = new Contact();
        $form = new ContactForm('contact', $contact, $this->container->getValidatorService());

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('contact'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($contact);
                $em->flush();

                //$this->container->getSessionService()->setFlash('project_create', array('project' => $project));
                return $this->redirect($this->generateUrl('contacts'));
            }
        }

        return $this->render('ChiaBundle:Contacts:new.twig', array('form' => $form));
    }
}
