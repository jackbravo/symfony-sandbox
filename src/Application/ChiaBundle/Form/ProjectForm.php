<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Project;
use Application\ChiaBundle\Entity\Contact;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

class ProjectForm extends Form
{
    public function configure()
    {
        $this->addRequiredOption('contact_choices');
        $this->addRequiredOption('entity_manager');
        $em = $this->getOption('entity_manager');

        $this->add(new TextField('name'));

        $contactTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Contact',
        ));
        $contactField = new AutocompleteField('contact', array(
            'choices' => $this->getOption('contact_choices'),
        ));
        $contactField->setValueTransformer($contactTransformer);
        $this->add($contactField);

        $this->add(new TextareaField('description'));
    }
}
