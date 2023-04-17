<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $searchTerm = $request->query->get('q');


        $user = $userRepository->search($searchTerm);

        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        dump($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->getData()['search'];

dump($user);
            return $this->redirectToRoute('search/index.html.twig', ['b' => $searchTerm]);
        }


        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'users' => $user,
        ]);
    }
}

