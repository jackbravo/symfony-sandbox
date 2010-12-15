<?php

namespace Application\ChiaBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\ChoiceField;
use Symfony\Component\Form\TextareaField;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

class ModifyProjectForm extends Form
{
    public function configure()
    {
        $this->addRequiredOption('entity_manager');
        $em = $this->getOption('entity_manager');

        $statusTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Status',
        ));
        $statusField = new ChoiceField('status', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\Status')->getStatusOptions(),
        ));
        $statusField->setValueTransformer($statusTransformer);
        $this->add($statusField);

        $noteField = new TextareaField('new_note');
        $this->add($noteField);
    }
}
