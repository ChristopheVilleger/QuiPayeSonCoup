<?php

namespace UserBundle\Service;

use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;
use AppBundle\Entity\Room;

class UserService{

    /** @var EntityManager $em */
    protected $em;

    /** @var \Doctrine\ORM\EntityRepository $userRepository */
    protected $userRepository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
        $this->userRepository = $this->em->getRepository('UserBundle:User');
    }

    /**
     * Return all user
     * @return array
     */
    public function getUsers(){
        return $this->userRepository->findAll();
    }

    /**
     * Return a random User of an Users's array
     * @param array $users
     * @return User
     */
    public function getRandomUserByUsers($users){
        $randomKey = array_rand($users); // Return one random entry out of an array of User, and returns the key.
        return $users[$randomKey];
    }

    /**
    * Search for a User through username
    * Return an array of User
    * @param String $term
    * @return array
    */
    function searchUserByUsername($term){
        return $this->userRepository->createQueryBuilder('u')
            ->where('u.username LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->getQuery()
            ->getResult();
    }

    /**
     * Save a User
     * @param User $user
     */
    public function save(User $user){
        $this->em->persist($user);
        $this->em->flush($user);
    }

    /**
     * Remove a User
     * @param User $user
     */
    public function remove(User $user){
        $this->em->remove($user);
        $this->em->flush($user);
    }


}
