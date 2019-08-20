<?php

namespace InstitutoAtlanticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use InstitutoAtlanticoBundle\Entity\Rating;
use Symfony\Component\HttpFoundation\Request;

class RatingController extends Controller
{
    public function listByUserAction($idUser)
    {
        $service = $this->container->get('rating_service');
        $ratings = $this->get('jms_serializer')->serialize($service->getRatingsByUser($idUser),'json');
        $response = new Response($ratings, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function listByMovieAction($idMovie)
    {
        $service = $this->container->get('rating_service');
        $ratings = $this->get('jms_serializer')->serialize($service->getRatingsByMovie($idMovie),'json');
        $response = new Response($ratings, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
