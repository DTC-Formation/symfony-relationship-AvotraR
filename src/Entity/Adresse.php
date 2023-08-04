<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdresseRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['listing'])]
    private ?int $id = null;

    #[Groups(['listing'])]
    #[ORM\Column(length: 255)]
    private ?string $Lot = null;

    #[Groups(['listing'])]
    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\OneToOne(mappedBy: 'Adresse', cascade: ['persist', 'remove'])]
    private ?User $user = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLot(): ?string
    {
        return $this->Lot;
    }

    public function setLot(string $Lot): static
    {
        $this->Lot = $Lot;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getAdresse() !== $this) {
            $user->setAdresse($this);
        }

        $this->user = $user;

        return $this;
    }

}
