<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ApiEleveController extends AbstractController
{
    #[Route('/api/eleve', name: 'app_api_eleve', methods:['POST'])]
    public function index(Request $request, MessageRepository $messageRepository): Response
    {

        $data = json_decode($request->getContent(), true);


        $message_send = $data['message_send'];

        //$prenom = $request->getContent('prenom');

        $message = new Message();
        $message->setMessageSend($message_send);


        //$user->setNom($nom);

        $messageRepository->save($message, true);

        $response = ['message' => $message_send ];

        return new Response(json_encode($response), 200, [
    'Content-Type' => 'application/json'
]);


        //return new Response('prenom créer', $user->getPrenom());
        //return new Response($response);


    }
}
