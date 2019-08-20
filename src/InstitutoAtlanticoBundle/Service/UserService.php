<?php

namespace InstitutoAtlanticoBundle\Service;

use Doctrine\ORM\EntityManager;
use InstitutoAtlanticoBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserService
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('InstitutoAtlanticoBundle:User');
    }

    public function getAllUsers()
    {
        return $this->repository->findAll();
    }

    public function saveUser(Request $request, int $id = null)
    {
        $data = $request->request->all();
        $user = $id !== null ? $this->repository->findOneBy(['id' => $id]) : new User();
        $user->setName($data['name'] ?? $user->getName());
        $user->setEmail($data['email'] ?? $user->getEmail());
        return $this->repository->persist($user);

    }

    public function deleteUser($id)
    {
        $user = $this->repository->findOneBy(['id' => $id]);
        return $this->repository->remove($user);
    }
}