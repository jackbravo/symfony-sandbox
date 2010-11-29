<?php

namespace Application\ChiaBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

class ContactForm extends Form
{
    public function configure()
    {
        $this->addRequiredOption('entity_manager');
        $this->addRequiredOption('company_choices');
        $contactTransformer = new EntityToIDTransformer(array(
            'em' => $this->getOption('entity_manager'),
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
    }
}
