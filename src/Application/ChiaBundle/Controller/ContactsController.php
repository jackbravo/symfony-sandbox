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
        return $this->render('ChiaBundle:Contacts:index.php', array('contacts' => $contacts));
    }

    public function newAction()
    {
        $contact = new Contact();
        $form = new ContactForm('contact', $contact, $this->container->getValidatorService());
        return $this->render('ChiaBundle:Contacts:new.php', array('form' => $form));
    }
}
