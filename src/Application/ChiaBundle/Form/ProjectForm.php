<?php

namespace Application\ChiaBundle\Form;

use Application\ChiaBundle\Entity\Project;
use Application\ChiaBundle\Entity\Contact;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\DateField;
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

        $statusTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Status',
        ));
        $statusField = new ChoiceField('status', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\Status')->getStatusOptions(),
        ));
        $statusField->setValueTransformer($statusTransformer);
        $this->add($statusField);

        $contactTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\Contact',
        ));
        $contactField = new AutocompleteField('contact', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\Contact')->getCompanyOptions(),
        ));
        $contactField->setValueTransformer($contactTransformer);
        $this->add($contactField);

        $userTransformer = new EntityToIDTransformer(array(
            'em' => $em,
            'className' => 'Application\ChiaBundle\Entity\User',
        ));
        $ownerField = new ChoiceField('owner', array(
            'choices' => $em->getRepository('Application\ChiaBundle\Entity\User')->getUserOptions(),
        ));
        $ownerField->setValueTransformer($userTransformer);
        $this->add($ownerField);

        $this->add(new TextareaField('description'));
        $this->add(new MoneyField('price'));
        $this->add(new ChoiceField('price_type', array('choices' => Project::$price_types)));
        $this->add(new DateField('estimated_start_date'));

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

    public function doBind(array $taintedData)
    {
        $valid = parent::doBind($taintedData);

        if (!is_numeric($taintedData['contact'])) {
            $em = $this->getOption('entity_manager');
            $company = new Contact();
            $company->setName($taintedData['contact']);
            $company->setType(2);
            $this->getData()->setContact($company);
            $em->persist($company);
        }

        return $valid;
    }
}
