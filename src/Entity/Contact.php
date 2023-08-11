<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContactRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['listing','creating'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['listing','creating'])]
    private ?int $Tel = null;

    #[Groups(['listing','creating'])]
    #[ORM\Column(length: 255)]
    private ?string $mail;

    #[Groups(['listing','creating'])]
    #[ORM\Column(length: 255)]
    private ?string $linkdin;

    #[ORM\ManyToOne(inversedBy: 'Contact', cascade: ['persist', 'remove'])]
    private ?User $user = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTel(): ?int
    {
        return $this->Tel;
    }

    public function setTel(int $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getLinkdin(): ?string
    {
        return $this->linkdin;
    }

    public function setLinkdin(string $linkdin): static
    {
        $this->linkdin = $linkdin;

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
