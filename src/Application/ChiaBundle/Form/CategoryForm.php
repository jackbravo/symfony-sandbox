<?php

namespace Application\ChiaBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;

class CategoryForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('name'));
    }
}
