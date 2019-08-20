<?php

namespace InstitutoAtlanticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use InstitutoAtlanticoBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function listAction()
    {
        $service = $this->container->get('user_service');
        $users = $this->get('jms_serializer')->serialize($service->getAllUsers(),'json');
        $response = new Response($users, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function showAction(User $user)
    {
        $user = $this->get('jms_serializer')->serialize($user,'json');
        $response = new Response($user, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function saveAction(Request $request)
    {
        $service = $this->container->get('user_service');
        $user = $this->get('jms_serializer')->serialize($service->saveUser($request),'json');
        $response = new Response($user, 201);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function updateAction(Request $request, $id)
    {
        $service = $this->container->get('user_service');
        $user = $this->get('jms_serializer')->serialize($service->saveUser($request, $id),'json');
        $response = new Response($user, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function deleteAction($id)
    {
        $service = $this->container->get('user_service');
        $user = $this->get('jms_serializer')->serialize($service->deleteUser($id),'json');
        $response = new Response($user, 204);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
