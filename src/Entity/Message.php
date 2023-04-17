<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $message_send = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message_receved = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageSend(): ?string
    {
        return $this->message_send;
    }

    public function setMessageSend(string $message_send): self
    {
        $this->message_send = $message_send;

        return $this;
    }

    public function getMessageReceved(): ?string
    {
        return $this->message_receved;
    }

    public function setMessageReceved(?string $message_receved): self
    {
        $this->message_receved = $message_receved;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
