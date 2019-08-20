<?php

namespace InstitutoAtlanticoBundle\Service;

use Doctrine\ORM\EntityManager;
use InstitutoAtlanticoBundle\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;

class MovieService
{
    private $em;
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('InstitutoAtlanticoBundle:Movie');
    }

    public function getAllMovies()
    {
        return $this->repository->findAll();
    }

    public function saveMovie(Request $request, int $id = null)
    {
        $data = $request->request->all();
        $movie = $id !== null ? $this->repository->findOneBy(['id' => $id]) : new Movie();
        $movie->setTitle($data['title'] ?? $movie->getTitle());
        return $this->repository->persist($movie);

    }

    public function deleteMovie($id)
    {
        $movie = $this->repository->findOneBy(['id' => $id]);
        return $this->repository->remove($movie);
    }
}