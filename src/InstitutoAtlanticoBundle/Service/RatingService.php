<?php

namespace InstitutoAtlanticoBundle\Service;

use Doctrine\ORM\EntityManager;
use InstitutoAtlanticoBundle\Entity\Rating;
use Symfony\Component\HttpFoundation\Request;

class RatingService
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('InstitutoAtlanticoBundle:Rating');
    }

    public function getRatingsByUser($idUser)
    {
        return $this->repository->findBy(['user' => $idUser]);
    }

    public function getRatingsByMovie($idMovie)
    {
        return $this->repository->findBy(['movie' => $idMovie]);
    }
}