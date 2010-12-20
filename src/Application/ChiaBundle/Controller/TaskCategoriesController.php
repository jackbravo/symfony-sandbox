<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\TaskCategory;
use Application\ChiaBundle\Form\TaskCategoryForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskCategoriesController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $categories = $em->getRepository('Application\ChiaBundle\Entity\TaskCategory')->getAll();

        return $this->render('ChiaBundle:TaskCategories:index.twig', array('categories' => $categories));
    }

    public function newAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $category = new TaskCategory();

        $form = new TaskCategoryForm('category', $category, $this->container->get('validator'));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('category'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($category);
                $em->flush();

                //$this->container->getSessionService()->setFlash('category_create', array('category' => $category));
                return $this->redirect($this->generateUrl('task_categories'));
            }
        }

        return $this->render('ChiaBundle:TaskCategories:new.twig', array('form' => $form));
    }

    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $category = $em->find('Application\ChiaBundle\Entity\TaskCategory', $id);

        $form = new TaskCategoryForm('category', $category, $this->container->get('validator'));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('category'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($category);
                $em->flush();

                //$this->container->getSessionService()->setFlash('category_create', array('category' => $category));
                return $this->redirect($this->generateUrl('task_categories'));
            }
        }

        return $this->render('ChiaBundle:TaskCategories:edit.twig', array('form' => $form, 'category' => $category));
    }
}
