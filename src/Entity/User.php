<?php

namespace App\Entity;

use Symfony\Component\Uid\Ulid;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    
    #[ORM\Id]
    #[ORM\Column(type:"uuid", unique:true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class:'doctrine.uuid_generator')]
    #[Groups(['listing'])]
    private ?Uuid $id;

    #[Groups(['listing','creating'])]
    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[Groups(['listing','creating'])]
    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[Groups(['listing','creating'])]
    #[ORM\Column]
    private ?int $Age = null;

    #[Groups(['listing','creating'])]
    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $Adresse = null;

    #[Groups(['listing','creating'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Contact::class, cascade: ['persist', 'remove'])]
    private Collection $Contact;

    #[Groups(['listing'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Etudes::class, cascade: ['persist', 'remove'])]
    private Collection $Etudes;

    #[Groups(['listing'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Experiences::class, cascade: ['persist', 'remove'])]
    private Collection $Experience;

    public function __construct()
    {
        $this->Contact = new ArrayCollection();
        $this->Etudes = new ArrayCollection();
        $this->Experience = new ArrayCollection();
    }


    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): static
    {
        $this->Age = $Age;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->Adresse;
    }

    public function setAdresse(Adresse $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->Contact;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->Contact->contains($contact)) {
            $this->Contact->add($contact);
            $contact->setUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->Contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUser() === $this) {
                $contact->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etudes>
     */
    public function getEtudes(): Collection
    {
        return $this->Etudes;
    }

    public function addEtude(Etudes $etude): static
    {
        if (!$this->Etudes->contains($etude)) {
            $this->Etudes->add($etude);
            $etude->setUser($this);
        }

        return $this;
    }

    public function removeEtude(Etudes $etude): static
    {
        if ($this->Etudes->removeElement($etude)) {
            // set the owning side to null (unless already changed)
            if ($etude->getUser() === $this) {
                $etude->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Experiences>
     */
    public function getExperience(): Collection
    {
        return $this->Experience;
    }

    public function addExperience(Experiences $experience): static
    {
        if (!$this->Experience->contains($experience)) {
            $this->Experience->add($experience);
            $experience->setUser($this);
        }

        return $this;
    }

    public function removeExperience(Experiences $experience): static
    {
        if ($this->Experience->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }


}
