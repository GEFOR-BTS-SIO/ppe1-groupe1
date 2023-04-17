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

//     #[Route('/user', name: 'app_user')]
//     public function User(UserRepository $userRepository, FormationRepository $formationRepository): Response
//     {
//         // Récupérer les données des entités User et Profil depuis la base de données
//         $users = $this->getUser();
// dump($users);
//         //$formation = $FormationRepository->findAll();     
 
//         // Transmettre les données à la vue Twig pour les afficher
//         return $this->render('user/index.html.twig', [
//             'user' => $users,

//         ]);
//     }

    #[Route('/toto', name: 'app_toto', methods: ['GET', 'POST'])]
    public function Toto(Request $request, UserRepository $userRepository): Response
    {
         $user = $this->getUser();
            dump($user);

        
        $form = $this->createForm(ParentFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Handle form submission
            // You can access your child form data like this:
            $user = $form->get('user')->getData();
            $formation = $form->get('formation')->getData();
                

        }
        
        return $this->render('user/test.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
    }

