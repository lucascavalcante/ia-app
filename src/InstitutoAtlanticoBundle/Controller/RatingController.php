<?php

namespace InstitutoAtlanticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RatingController extends Controller
{
    public function listByUserAction($userId = null)
    {
        $service = $this->container->get('rating_service');
        $ratings = $this->get('jms_serializer')->serialize($service->getRatingsByUser($userId),'json');
        $response = new Response($ratings, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function listAllUsersAction()
    {
        $service = $this->container->get('rating_service');
        $ratings = $this->get('jms_serializer')->serialize($service->getRatingsAllUsers(),'json');
        $response = new Response($ratings, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function listByMovieAction($movieId)
    {
        $service = $this->container->get('rating_service');
        $ratings = $this->get('jms_serializer')->serialize($service->getRatingsByMovie($movieId),'json');
        $response = new Response($ratings, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function listAllMoviesAction()
    {
        $service = $this->container->get('rating_service');
        $ratings = $this->get('jms_serializer')->serialize($service->getRatingsAllMovies(),'json');
        $response = new Response($ratings, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
