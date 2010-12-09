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

        $get_which = $this->get('request')->query->get('which');
        $which = $get_which ? $get_which : $this->get('session')->get('contacts.which');
        $this->get('session')->set('contacts.which', $which);

        if ($which == "people") {
            $contacts = $em->getRepository('Application\ChiaBundle\Entity\Contact')->getPeople();
        } else if ($which == "companies") {
            $contacts = $em->getRepository('Application\ChiaBundle\Entity\Contact')->getCompanies();
        } else {
            $contacts = $em->getRepository('Application\ChiaBundle\Entity\Contact')->getAll();
        }

        return $this->render('ChiaBundle:Contacts:index.twig', array('contacts' => $contacts));
    }

    public function newAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $contact = new Contact();
        $contact->setType(1);

        $form = new ContactForm('contact', $contact, $this->container->get('validator'), array(
            'entity_manager' => $em,
            'company_choices' => $em->getRepository('Application\ChiaBundle\Entity\Contact')->getCompanyOptions(),
        ));

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

    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $contact = $em->find('Application\ChiaBundle\Entity\Contact', $id);

        $form = new ContactForm('contact', $contact, $this->container->get('validator'), array(
            'entity_manager' => $em,
            'company_choices' => $em->getRepository('Application\ChiaBundle\Entity\Contact')->getCompanyOptions(),
        ));

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

        return $this->render('ChiaBundle:Contacts:edit.twig', array('form' => $form, 'contact' => $contact));
    }

    public function newCompanyAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $contact = new Contact();
        $contact->setType(2);
        $form = new ContactForm('contact', $contact, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

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

        return $this->render('ChiaBundle:Contacts:new_company.twig', array('form' => $form));
    }
}
