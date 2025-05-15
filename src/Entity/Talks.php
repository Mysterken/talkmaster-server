<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TalksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TalksRepository::class)]
#[ApiResource]
class Talks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $day = null;

    #[ORM\Column]
    private ?int $moment = null;

    #[ORM\Column(length: 50)]
    private ?string $state = null;

    #[ORM\ManyToOne(inversedBy: 'talks')]
    private ?usersTalk $userTalk = null;

    #[ORM\ManyToOne(inversedBy: 'talks')]
    private ?Rooms $room = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getMoment(): ?int
    {
        return $this->moment;
    }

    public function setMoment(int $moment): static
    {
        $this->moment = $moment;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getUserTalk(): ?usersTalk
    {
        return $this->userTalk;
    }

    public function setUserTalk(?usersTalk $userTalk): static
    {
        $this->userTalk = $userTalk;

        return $this;
    }

    public function getRoom(): ?Rooms
    {
        return $this->room;
    }

    public function setRoom(?Rooms $room): static
    {
        $this->room = $room;

        return $this;
    }
}
