<?php

namespace Application\ChiaBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\CheckboxField;

class StatusForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('name'));
        $this->add(new TextField('value'));
        $this->add(new CheckboxField('active'));
    }
}
