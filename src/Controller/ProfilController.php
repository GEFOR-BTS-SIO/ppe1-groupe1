<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\AdminType;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\FormationRepository;
use App\Form\ParentFormType ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil_index', methods: ['GET', 'POST'])]
    public function index(Request $request, UserRepository $userRepository, FormationRepository $formationRepository): Response
    {
        $utilisateur = $this->getUser();
        $users = $userRepository->findAll();
        $formations = $formationRepository->findAll();

        if ($this->isGranted('ROLE_ADMIN')) {
            // Utilisateur avec le rôle admin
            $form = $this->createForm(AdminType::class, $utilisateur);
            // ...
            // Effectue les actions spécifiques à l'administrateur

            return $this->render('profil/edit-admin.html.twig', [
                'form' => $form->createView(),
                'utilisateur' => $utilisateur,
                'users' => $users,
                'formations' => $formations,
            ]);
        } else {
            // Utilisateur non-admin
            $form = $this->createForm(UserType::class, $utilisateur);
            // ...
            // Effectue les actions spécifiques à l'utilisateur non-admin

            return $this->render('profil/edit.html.twig', [
                'form' => $form->createView(),
                'utilisateur' => $utilisateur,
                'users' => $users,
                'formations' => $formations,
            ]);
        }
    }

    #[Route('/new', name: 'app_profil_new', methods: ['GET', 'POST'])]

    public function new(Request $request, UserRepository $userRepository, SluggerInterface $slugger, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plaintextPassword = $form->get('password')->getData();
            if (!empty($plaintextPassword)) {
                $hasedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hasedPassword);
            }
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('stockage'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $user->setPhoto($newFilename);
            }

            $userRepository->save($user, true);

            return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_profil_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('profil/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, FormationRepository $formationRepository, SluggerInterface $slugger, UserPasswordHasherInterface $passwordHasher): Response
    {
 $user = $this->getUser();
$formation = $formationRepository->findAll();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            #condition pour hacher le password
            $plaintextPassword = $form->get('password')->getData();
            if (!empty($plaintextPassword)) {
                $hasedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hasedPassword);
            }


            #condition pour importer les images
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('stockage'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $user->setPhoto($newFilename);
            }

            $userRepository->save($user, true);

            return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/edit.html.twig', [
            'idformation'=>$formationRepository,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'app_profil_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {

            if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
                $session = $this->get('session');
                $session = new Session();
                $session->invalidate();
                $userRepository->remove($user, true);
                $currentUserId = $this->getUser()->getId();
        }

        return $this->redirectToRoute('app_login', [

        ]);
       // return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }
}
