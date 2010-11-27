<?php

namespace Application\ChiaBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;

class ContactForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('name'));
        $this->add(new TextField('title'));
        $this->add(new TextField('code'));
        $this->getData()->setType('1');
        $this->add(new TextareaField('description'));
    }
}
