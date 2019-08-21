<?php

namespace InstitutoAtlanticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RecommendationController extends Controller
{
    public function listRecommendationByUserAction($userId)
    {
        $service = $this->container->get('recommendation_service');
        $recommendations = $this->get('jms_serializer')->serialize($service->getRecommendationsByUser($userId),'json');
        $response = new Response($recommendations, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
