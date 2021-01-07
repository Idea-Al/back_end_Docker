<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user", name="user", methods={"GET"})
     */
    public function index( SerializerInterface $serializer, UserRepository $userRepo): Response
    {
        $users = $userRepo->findAll();

        $json = $serializer->serialize($users, 'json', ['groups' => 'user:read']);

        $response = new Response($json, 200, [], ['groups' => 'user:read']);

        return $response;
    }
}
