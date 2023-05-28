<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormationRepository;
use App\Repository\UserRepository;
use App\Form\ParentFormType;





use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
#[Route('/user', name: 'app_user')]
public function user(Request $request, UserRepository $userRepository, FormationRepository $formationRepository): Response
    {
        $user = $this->getUser();
        $formation = $formationRepository->findAll();     
        $form = $this->createForm(ParentFormType::class);
        $form->handleRequest($request);
    
        return $this->render('user/index.html.twig', [
            'idformation' => $formation,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}

