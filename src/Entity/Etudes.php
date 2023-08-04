<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EtudesRepository::class)]
class Etudes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['listing'])]
    private ?int $id = null;

    #[Groups(['listing'])]
    #[ORM\Column(length: 255)]
    private ?string $Diplomes = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\ManyToOne(inversedBy: 'Etudes', cascade: ['persist', 'remove'])]
    private ?User $user = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiplomes(): ?string
    {
        return $this->Diplomes;
    }

    public function setDiplomes(string $Diplomes): static
    {
        $this->Diplomes = $Diplomes;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }


}
