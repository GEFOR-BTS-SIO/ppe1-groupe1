<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\SearchType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, UserRepository $userRepository, Security $security): Response
    {
        $searchTerm = $request->query->get('q');
        $sort = $request->query->get('sort');

        $user = $userRepository->search($searchTerm);

        // Tri utilisateurs en fonction du paramètre de tri
    if ($sort === 'alphabetical') {
        usort($user, function ($a, $b) {
            return strcmp($a->getNom(), $b->getNom());
        });
    }

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
            'sort' => $sort,
        ]);
    }
}

