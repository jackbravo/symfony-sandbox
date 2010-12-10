<?php

namespace Application\ChiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChiaBundle:Admin:index.twig');
    }
}
