<?php

namespace Application\ChiaBundle\Menu;

use Bundle\MenuBundle\Menu;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class ToolsMenu extends Menu
{
    public function __construct(Request $request, Router $router)
    {
        parent::__construct();

        $this->setCurrentUri($request->getRequestUri());

        $this->addChild('Admin', $router->generate('admin'));
        $this->addChild('Sign out', $router->generate('_security_logout'));

        $this->setAttributes(array('id'=>'tools-menu', 'class'=>'menu'));
    }
}
