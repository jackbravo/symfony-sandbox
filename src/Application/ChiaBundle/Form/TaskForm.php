<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Task;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\DateField;
use Symfony\Component\Form\ChoiceField;
use Symfony\Component\Form\HiddenField;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

class TaskForm extends Form
{
    public function configure()
    {
        $this->addRequiredOption('entity_manager');
        $em = $this->getOption('entity_manager');

        $this->add(new TextField('task'));
        $this->add(new DateField('due_date'));

        $userTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\User',
        ));
        $ownerField = new ChoiceField('owner', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\User')->getUserOptions(),
        ));
        $ownerField->setValueTransformer($userTransformer);
        $this->add($ownerField);

        $categoryTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\TaskCategory',
        ));
        $categoryField = new ChoiceField('category', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\TaskCategory')->getCategoryOptions(),
            'empty_value' => 'Select a category...',
        ));
        $categoryField->setValueTransformer($categoryTransformer);
        $this->add($categoryField);

        $projectTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Project',
        ));
        $projectField = new HiddenField('project');
        $projectField->setValueTransformer($projectTransformer);
        $this->add($projectField);
    }
}
