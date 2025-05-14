<?php

namespace App\Entity;

use App\Repository\UsersTalkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersTalkRepository::class)]
class UsersTalk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $name = null;

    #[ORM\Column(length: 32)]
    private ?string $lastName = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $token = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var Collection<int, Talks>
     */
    #[ORM\OneToMany(targetEntity: Talks::class, mappedBy: 'userTalk')]
    private Collection $talks;

    public function __construct()
    {
        $this->talks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection<int, Talks>
     */
    public function getTalks(): Collection
    {
        return $this->talks;
    }

    public function addTalk(Talks $talk): static
    {
        if (!$this->talks->contains($talk)) {
            $this->talks->add($talk);
            $talk->setUserTalk($this);
        }

        return $this;
    }

    public function removeTalk(Talks $talk): static
    {
        if ($this->talks->removeElement($talk)) {
            // set the owning side to null (unless already changed)
            if ($talk->getUserTalk() === $this) {
                $talk->setUserTalk(null);
            }
        }

        return $this;
    }
}
