<?php

namespace Application\ChiaBundle\Controller;

use Application\ChiaBundle\Entity\Status;
use Application\ChiaBundle\Form\StatusForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatusController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $statuses = $em->getRepository('Application\ChiaBundle\Entity\Status')->findAll();

        return $this->render('ChiaBundle:Status:index.twig', array('statuses' => $statuses));
    }

    public function newAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $status = new Status();

        $form = new StatusForm('status', $status, $this->container->get('validator'));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('status'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($status);
                $em->flush();

                //$this->container->getSessionService()->setFlash('status_create', array('status' => $status));
                return $this->redirect($this->generateUrl('status'));
            }
        }

        return $this->render('ChiaBundle:Status:new.twig', array('form' => $form));
    }

    public function editAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $status = $em->find('Application\ChiaBundle\Entity\Status', $id);

        $form = new StatusForm('status', $status, $this->container->get('validator'));

        if('POST' === $this->get('request')->getMethod()) {
            $form->bind($this->get('request')->get('status'));
            if($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');
                $em->persist($status);
                $em->flush();

                //$this->container->getSessionService()->setFlash('status_create', array('status' => $status));
                return $this->redirect($this->generateUrl('status'));
            }
        }

        return $this->render('ChiaBundle:Status:edit.twig', array('form' => $form, 'status' => $status));
    }
}
