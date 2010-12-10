<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\Category;
use Application\ChiaBundle\Form\CategoryForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $categories = $em->getRepository('Application\ChiaBundle\Entity\Category')->findAll();

        return $this->render('ChiaBundle:Categories:index.twig', array('categories' => $categories));
    }

    public function newAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $category = new Category();

        $form = new CategoryForm('category', $category, $this->container->get('validator'));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('category'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($category);
                $em->flush();

                //$this->container->getSessionService()->setFlash('category_create', array('category' => $category));
                return $this->redirect($this->generateUrl('categories'));
            }
        }

        return $this->render('ChiaBundle:Categories:new.twig', array('form' => $form));
    }

    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $category = $em->find('Application\ChiaBundle\Entity\Category', $id);

        $form = new CategoryForm('category', $category, $this->container->get('validator'));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('category'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($category);
                $em->flush();

                //$this->container->getSessionService()->setFlash('category_create', array('category' => $category));
                return $this->redirect($this->generateUrl('categories'));
            }
        }

        return $this->render('ChiaBundle:Categories:edit.twig', array('form' => $form, 'category' => $category));
    }
}
