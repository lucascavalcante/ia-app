<?php

namespace InstitutoAtlanticoBundle\Service;

use Doctrine\ORM\EntityManager;

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

    public function getRatingsByUser($userId)
    {
        $ratings = $this->repository->findBy(['user' => $userId]);
        $arrayRatings = [];
        foreach($ratings as $rating) {
            $user = $this->userRepository->findOneBy(['id' => $rating->getUser()]);
            $movie = $this->movieRepository->findOneBy(['id' => $rating->getMovie()]);
            $arrayRatings['id'] = $userId;
            $arrayRatings['name'] = $user->getName();
            $arrayRatings['ratings'][$movie->getId()] = [
                'movie_id' => $movie->getId(),
                'movie' => $movie->getTitle(),
                'rating' => $rating->getRating()
            ];
        }

        return $arrayRatings;
    }

    public function getRatingsAllUsers()
    {
        $users = $this->repository->ratingsGroupedByUser();
        $arrayUsers = [];
        foreach($users as $user) {
            $arrayUsers[$user['user']] = $this->getRatingsByUser($user['user']);
        }
        
        return $arrayUsers;
    }

    public function getRatingsByMovie($movieId)
    {
        $ratings = $this->repository->findBy(['movie' => $movieId]);
        $arrayRatings = [];
        foreach($ratings as $rating) {
            $movie = $this->movieRepository->findOneBy(['id' => $rating->getMovie()]);
            $user = $this->userRepository->findOneBy(['id' => $rating->getUser()]);
            $arrayRatings['id'] = $movieId;
            $arrayRatings['title'] = $movie->getTitle();
            $arrayRatings['ratings'][$user->getId()] = [
                'user_id' => $user->getId(),
                'user' => $user->getName(),
                'rating' => $rating->getRating()
            ];
        }

        return $arrayRatings;
    }

    public function getRatingsAllMovies()
    {
        $movies = $this->repository->ratingsGroupedByMovie();
        $arrayMovies = [];
        foreach($movies as $movie) {
            $arrayMovies[$movie['movie']] = $this->getRatingsByMovie($movie['movie']);
        }
        
        return $arrayMovies;
    }
}