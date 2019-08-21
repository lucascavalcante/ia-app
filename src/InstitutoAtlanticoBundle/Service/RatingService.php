<?php

namespace InstitutoAtlanticoBundle\Service;

use Doctrine\ORM\EntityManager;
use InstitutoAtlanticoBundle\Entity\Rating;
use Symfony\Component\HttpFoundation\Request;

class RatingService
{
    private $em;
    private $repository;
    private $userRepository;
    private $movieRepository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('InstitutoAtlanticoBundle:Rating');
        $this->userRepository = $this->em->getRepository('InstitutoAtlanticoBundle:User');
        $this->movieRepository = $this->em->getRepository('InstitutoAtlanticoBundle:Movie');
    }

    public function getRatingsByUser($idUser)
    {
        $ratings = $this->repository->findBy(['user' => $idUser]);
        $arrayRatings = [];
        foreach($ratings as $rating) {
            $user = $this->userRepository->findOneBy(['id' => $rating->getUser()]);
            $movie = $this->movieRepository->findOneBy(['id' => $rating->getMovie()]);
            $arrayRatings[$user->getName()][] = [
                'movie' => $movie->getTitle(),
                'rating' => $rating->getRating()
            ];
        }

        return $arrayRatings;
    }

    public function getRatingsByMovie($idMovie)
    {
        $ratings = $this->repository->findBy(['movie' => $idMovie]);
        $arrayRatings = [];
        foreach($ratings as $rating) {
            $movie = $this->movieRepository->findOneBy(['id' => $rating->getMovie()]);
            $user = $this->userRepository->findOneBy(['id' => $rating->getUser()]);
            $arrayRatings[$movie->getTitle()][] = [
                'movie' => $user->getName(),
                'rating' => $rating->getRating()
            ];
        }

        return $arrayRatings;
    }
}