<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class SearchController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, UserRepository $userRepository, Security $security): Response
    {
        $searchTerm = $request->query->get('q');
        $user = $userRepository->search($searchTerm);
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $isGranted = $security->isGranted('ROLE_USER');
        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->getData()['search'];

            return $this->redirectToRoute('search/index.html.twig', ['q' => $searchTerm]);
        }


        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'users' => $user,
        ]);
    }
}

