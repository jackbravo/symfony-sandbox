<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Project;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\MoneyField;
use Symfony\Component\Form\ChoiceField;
use Symfony\Component\Form\TextareaField;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

class ProjectForm extends Form
{
    public function configure()
    {
        $project = $this->getData();

        $this->addRequiredOption('entity_manager');
        $em = $this->getOption('entity_manager');

        $this->add(new TextField('name'));

        if ($project->getId()) {
            $statusTransformer = new EntityToIDTransformer(array(
                'em' => $em,
                'className' => 'Application\ChiaBundle\Entity\Status',
            ));
            $statusField = new ChoiceField('status', array(
                'choices' => $em->getRepository('Application\ChiaBundle\Entity\Status')->getStatusOptions(),
            ));
            $statusField->setValueTransformer($statusTransformer);
            $this->add($statusField);
        } else {
            $project->setStatus($em->getRepository('Application\ChiaBundle\Entity\Status')->getDefaultStatus());
        }

        $contactTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Contact',
        ));
        $contactField = new AutocompleteField('contact', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\Contact')->getContactOptions(),
        ));
        $contactField->setValueTransformer($contactTransformer);
        $this->add($contactField);

        $userTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\User',
        ));
        $ownerField = new AutocompleteField('owner', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\User')->getUserOptions(),
        ));
        $ownerField->setValueTransformer($userTransformer);
        $this->add($ownerField);

        $this->add(new TextareaField('description'));
        $this->add(new MoneyField('price'));
        $this->add(new ChoiceField('price_type', array('choices' => Project::$price_types)));

        $categoryTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Category',
        ));
        $categoryField = new ChoiceField('category', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\Category')->getCategoryOptions(),
            'empty_value' => 'Select a category...',
        ));
        $categoryField->setValueTransformer($categoryTransformer);
        $this->add($categoryField);
    }
}
