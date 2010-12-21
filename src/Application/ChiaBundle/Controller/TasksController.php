<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\Task;
use Application\ChiaBundle\Form\TaskForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TasksController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $tasks = $em->getRepository('Application\ChiaBundle\Entity\Task')->getAll();

        return $this->render('ChiaBundle:Tasks:index.twig', array('tasks' => $tasks));
    }

    public function listAction($project)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $tasks = $em->getRepository('Application\ChiaBundle\Entity\Task')->getForProject($project);

        return $this->render('ChiaBundle:Tasks:list.twig', array('tasks' => $tasks));
    }

    public function newAction($project)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $task = new Task();
        $task->setOwner($this->container->get('security.context')->getUser()); // preload form with you as owner
        $task->setProject($project); // set the project for when the form gets submitted
        $task->setDueDate(new \DateTime()); // set the project for when the form gets submitted
        $form = new TaskForm('task', $task, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

        return $this->render('ChiaBundle:Tasks:form.twig', array('form' => $form));
    }

    public function createAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $task = new Task();
        $form = new TaskForm('task', $task, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

        $form->bind($this->get('request')->get('task'));
        if($form->isValid()) {
            $user = $this->container->get('security.context')->getUser();
            $task->setCreatedBy($user);
            $em->persist($task);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('projects_view', array('id' => $form->getData()->getProject()->getId())));
    }
}
