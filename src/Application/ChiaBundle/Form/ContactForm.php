<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Phonenumber;
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
        $this->addRequiredOption('entity_manager');
        $this->addRequiredOption('company_choices');

        $em = $this->getOption('entity_manager');
        $contactTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Contact',
        ));
        $companyField = new AutocompleteField('company', array(
            'choices' => $this->getOption('company_choices'),
        ));
        $companyField->setValueTransformer($contactTransformer);

        $this->add(new TextField('name'));
        $this->add(new TextField('title'));
        $this->add($companyField);
        $this->add(new TextField('code'));
        $this->getData()->setType('1');
        $this->add(new TextareaField('description'));

        $contact = $this->getData();
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
    }
}
