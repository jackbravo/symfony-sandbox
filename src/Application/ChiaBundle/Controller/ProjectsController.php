<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\Project;
use Application\ChiaBundle\Form\ProjectForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectsController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $projects = $em->getRepository('Application\ChiaBundle\Entity\Project')->findAll();

        return $this->render('ChiaBundle:Projects:index.twig', array('projects' => $projects));
    }

    public function newAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $project = new Project();

        $form = new ProjectForm('project', $project, $this->container->get('validator'), array(
            'entity_manager' => $em,
            'contact_choices' => $em->getRepository('Application\ChiaBundle\Entity\Contact')->getContactOptions(),
        ));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('project'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($project);
                $em->flush();

                //$this->container->getSessionService()->setFlash('project_create', array('project' => $project));
                return $this->redirect($this->generateUrl('projects'));
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
            'contact_choices' => $em->getRepository('Application\ChiaBundle\Entity\Contact')->getContactOptions(),
        ));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('project'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($project);
                $em->flush();

                //$this->container->getSessionService()->setFlash('project_create', array('project' => $project));
                return $this->redirect($this->generateUrl('projects'));
            }
        }

        return $this->render('ChiaBundle:Projects:edit.twig', array('form' => $form, 'project' => $project));
    }
}
