<?php

namespace Application\ChiaBundle\Menu;

use Bundle\MenuBundle\Menu;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class ChiaMenu extends Menu
{
    public function __construct(Request $request, Router $router)
    {
        parent::__construct();

        $this->setCurrentUri($request->getRequestUri());

        $this->addChild('Contacts', $router->generate('contacts'));
    }
}
