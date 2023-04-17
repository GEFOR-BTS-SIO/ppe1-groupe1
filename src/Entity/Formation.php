<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cursus = null;

    #[ORM\Column(nullable: true)]
    private ?int $annee = null;

    #[ORM\OneToMany(mappedBy: 'idformation', targetEntity: User::class)]
    private Collection $idusers;

    public function __construct()
    {
        $this->idusers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCursus(): ?string
    {
        return $this->cursus;
    }

    public function setCursus(?string $cursus): self
    {
        $this->cursus = $cursus;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdusers(): Collection
    {
        return $this->idusers;
    }

    public function addIduser(User $iduser): self
    {
        if (!$this->idusers->contains($iduser)) {
            $this->idusers->add($iduser);
            $iduser->setIdformation($this);
        }

        return $this;
    }

    public function removeIduser(User $iduser): self
    {
        if ($this->idusers->removeElement($iduser)) {
            // set the owning side to null (unless already changed)
            if ($iduser->getIdformation() === $this) {
                $iduser->setIdformation(null);
            }
        }

        return $this;
    }

    
    public function __toString()
{
    return $this->cursus;
}
}
