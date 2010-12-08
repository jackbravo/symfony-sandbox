<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Phonenumber;
use Application\ChiaBundle\Entity\Email;
use Application\ChiaBundle\Entity\Address;
use Application\ChiaBundle\Form\ValueTransformer\CollectionToGroupTransformer;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FieldGroup;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;
use Symfony\Component\Form\CollectionField;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

class ContactForm extends Form
{
    public function configure()
    {
        $contact = $this->getData();

        $this->addOption('company_choices');
        $this->addRequiredOption('entity_manager');
        $em = $this->getOption('entity_manager');

        $this->add(new TextField('name'));

        if ($contact->getType() == 1) {
            $this->add(new TextField('title'));

            $this->addRequiredOption('company_choices');
            $contactTransformer = new EntityToIDTransformer(array(
                'em' => $em,
                'className' => 'Application\ChiaBundle\Entity\Contact',
            ));
            $companyField = new AutocompleteField('company', array(
                'choices' => $this->getOption('company_choices'),
            ));
            $companyField->setValueTransformer($contactTransformer);

            $this->add($companyField);
        }

        $this->add(new TextField('code'));
        $this->add(new TextareaField('description'));

        // phone
        $phonesTransformer = new CollectionToGroupTransformer(array(
            'em' => $em,
            'fields' => array('number'),
            'className' => 'Application\ChiaBundle\Entity\Phonenumber',
            'create_instance_callback' => function() use ($contact, $em) {
                $phone = new Phonenumber();
                $contact->addPhonenumbers($phone);
                $phone->setContact($contact);
                $em->persist($phone);
                return $phone;
            },
            'remove_instance_callback' => function($phone) use ($contact, $em) {
                $contact->getPhonenumbers()->removeElement($phone);
                $em->remove($phone);
            },
        ));

        $phoneGroup = new FieldGroup('phonenumbers');
        $phoneGroup->add(new TextField('number'));
        $phones = new CollectionField($phoneGroup, array('modifiable' => true));
        $phones->setValueTransformer($phonesTransformer);

        $this->add($phones);

        // email
        $emailsTransformer = new CollectionToGroupTransformer(array(
            'em' => $em,
            'fields' => array('email'),
            'className' => 'Application\ChiaBundle\Entity\Email',
            'create_instance_callback' => function() use ($contact, $em) {
                $email = new Email();
                $contact->addEmails($email);
                $email->setContact($contact);
                $em->persist($email);
                return $email;
            },
            'remove_instance_callback' => function($email) use ($contact, $em) {
                $contact->getEmails()->removeElement($email);
                $em->remove($email);
            },
        ));

        $emailGroup = new FieldGroup('emails');
        $emailGroup->add(new TextField('email'));
        $emails = new CollectionField($emailGroup, array('modifiable' => true));
        $emails->setValueTransformer($emailsTransformer);

        $this->add($emails);

        // address
        $addressesTransformer = new CollectionToGroupTransformer(array(
            'em' => $em,
            'fields' => array('address', 'city', 'state', 'country', 'postal_code'),
            'className' => 'Application\ChiaBundle\Entity\Address',
            'create_instance_callback' => function() use ($contact, $em) {
                $address = new Address();
                $contact->addAddresses($address);
                $address->setContact($contact);
                $em->persist($address);
                return $address;
            },
            'remove_instance_callback' => function($address) use ($contact, $em) {
                $contact->getAddresses()->removeElement($address);
                $em->remove($address);
            },
        ));

        $addressGroup = new FieldGroup('addresses');
        $addressGroup->add(new TextareaField('address'));
        $addressGroup->add(new TextField('city'));
        $addressGroup->add(new TextField('state'));
        $addressGroup->add(new TextField('country'));
        $addressGroup->add(new TextField('postal_code'));
        $addresses = new CollectionField($addressGroup, array('modifiable' => true));
        $addresses->setValueTransformer($addressesTransformer);

        $this->add($addresses);
    }
}
