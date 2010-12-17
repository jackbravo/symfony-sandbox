<?php

namespace Application\ChiaBundle\Entity;

use Bundle\DoctrineUserBundle\Entity\UserRepository as BaseUserRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends BaseUserRepository
{
    public function getUserOptions()
    {
        $users = $this->_em->createQuery('SELECT c FROM ChiaBundle:User c WHERE c.isActive = 1 ORDER BY c.username')
            ->getArrayResult();
        $user_choices = array();
        foreach ($users as $user) {
            $user_choices[$user['id']] = $user['username'];
        }
        return $user_choices;
    }
}
