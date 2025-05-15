<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\UsersTalk;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/home')]
final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route('/createAccount', name: 'app_create_account', methods: ['POST'])]
    public function createAccount(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): JsonResponse
    {
        $newUser = new UsersTalk();
        $newUser->setName($_REQUEST['name']);
        $newUser->setLastName($_REQUEST['last_name']);
        $newUser->setEmail($_REQUEST['email']);
        $password = $_REQUEST['password'];
        $token = $hasher->hashPassword(
            $newUser,
            $password
        );
        $newUser->setToken($token);
        $newUser->setRoles([$_REQUEST['role']]);
        $entityManager->persist($newUser);
        $entityManager->flush();

        return $this->json([
            'message' => 'Votre nouveau compte a été créé avec succès'
        ]);
    }
}
