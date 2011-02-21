<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\Project;
use Application\ChiaBundle\Form\ProjectForm;
use Application\ChiaBundle\Form\ModifyProjectForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectsController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $get_which = $this->get('request')->query->get('which');
        $which = $get_which ? $get_which : $this->get('session')->get('contacts.which');
        $this->get('session')->set('contacts.which', $which);

        if ($which == "won") {
            $projects = $em->getRepository('Application\ChiaBundle\Entity\Project')->getWon();
        } else if ($which == "lost") {
            $projects = $em->getRepository('Application\ChiaBundle\Entity\Project')->getLost();
        } else {
            $which = 'open';
            $projects = $em->getRepository('Application\ChiaBundle\Entity\Project')->getOpen();
        }

        return $this->render('ChiaBundle:Projects:index.twig', array(
            'which' => $which,
            'projects' => $projects,
            'price_types' => Project::$price_types,
        ));
    }

    public function newAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $project = new Project();

        $form = new ProjectForm('project', $project, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('project'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($project);
                $em->flush();

                //$this->container->getSessionService()->setFlash('project_create', array('project' => $project));
                return $this->redirect($this->generateUrl('projects_view', array('id'=>$project->getId())));
            }
        }

        return $this->render('ChiaBundle:Projects:new.twig', array('form' => $form));
    }

    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $project = $em->find('Application\ChiaBundle\Entity\Project', $id);

        $form = new ProjectForm('project', $project, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('project'));
            if($form->isValid()) {
                $user = $this->container->get('security.context')->getUser();
                $project->getLastNote()->setCreatedBy($user);
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($project);
                $em->persist($project->getLastNote());
                $em->flush();

                $this->notifyProjectWatchers($project, $user);

                //$this->container->getSessionService()->setFlash('project_create', array('project' => $project));
                return $this->redirect($this->generateUrl('projects_view', array('id'=>$project->getId())));
            }
        }

        return $this->render('ChiaBundle:Projects:edit.twig', array('form' => $form, 'project' => $project));
    }

    public function modifyAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $project = $em->find('Application\ChiaBundle\Entity\Project', $id);

        $form = new ModifyProjectForm('project', $project, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

        $form->bind($this->get('request')->get('project'));
        if($form->isValid()) {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $user = $this->container->get('security.context')->getUser();
            $project->getLastNote()->setCreatedBy($user);
            $em->persist($project);
            $em->persist($project->getLastNote());
            $em->flush();

            $this->notifyProjectWatchers($project, $user);

            //$this->container->getSessionService()->setFlash('project_create', array('project' => $project));
            return $this->redirect($this->generateUrl('projects_view', array('id'=>$project->getId())));
        }
        else {
            return $this->render('ChiaBundle:Projects:view.twig', array('form' => $form, 'project' => $project));
        }
    }

    public function viewAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $project = $em->find('Application\ChiaBundle\Entity\Project', $id);

        $form = new ModifyProjectForm('project', $project, $this->container->get('validator'), array(
            'entity_manager' => $em,
        ));

        return $this->render('ChiaBundle:Projects:view.twig', array(
            'project' => $project,
            'form' => $form,
        ));
    }

    public function notifyProjectWatchers($project, $from)
    {
        if ($from != $project->getOwner())
        {
            $mailer = $this->get('mailer');

            $message = \Swift_Message::newInstance()
                ->setSubject("[Project {$project}] was updated by {$from}")
                ->setFrom($from->getEmail())
                ->setTo($project->getOwner()->getEmail())
                ->setBody($this->renderView('ChiaBundle:Projects:email.twig', array('project' => $project)))
            ;
            $mailer->send($message);

            $this->get('request')->getSession()->setFlash('notice', 'Email sent');
        }
    }
}
