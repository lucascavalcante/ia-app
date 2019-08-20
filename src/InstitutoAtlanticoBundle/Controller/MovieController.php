<?php

namespace InstitutoAtlanticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use InstitutoAtlanticoBundle\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
    public function listAction()
    {
        $service = $this->container->get('movie_service');
        $movies = $this->get('jms_serializer')->serialize($service->getAllMovies(),'json');
        $response = new Response($movies, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function showAction(Movie $movie)
    {
        $movie = $this->get('jms_serializer')->serialize($movie,'json');
        $response = new Response($movie, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function saveAction(Request $request)
    {
        $service = $this->container->get('movie_service');
        $movie = $this->get('jms_serializer')->serialize($service->saveMovie($request),'json');
        $response = new Response($movie, 201);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function updateAction(Request $request, $id)
    {
        $service = $this->container->get('movie_service');
        $movie = $this->get('jms_serializer')->serialize($service->saveMovie($request, $id),'json');
        $response = new Response($movie, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function deleteAction($id)
    {
        $service = $this->container->get('movie_service');
        $movie = $this->get('jms_serializer')->serialize($service->deleteMovie($id),'json');
        $response = new Response($movie, 204);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
