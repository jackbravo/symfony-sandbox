<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Project;
use Application\ChiaBundle\Entity\Contact;

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

        $this->addRequiredOption('contact_choices');
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
            'choices' => $this->getOption('contact_choices'),
        ));
        $contactField->setValueTransformer($contactTransformer);
        $this->add($contactField);

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
