<?php

namespace Application\ChiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{
    public function getForProject($project)
    {
        return $this->_em->createQuery("
            SELECT t.id, t.task, t.due_date, t.created_at, t.updated_at, c.name as category, u.username
            FROM ChiaBundle:Task t
                LEFT JOIN t.project p
                LEFT JOIN t.category c
                LEFT JOIN t.created_by u
            WHERE p.id = {$project->getId()}
                AND t.done = FALSE
            ORDER BY t.due_date")
            ->getArrayResult();
    }
}
