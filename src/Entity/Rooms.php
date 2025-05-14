<?php

namespace App\Entity;

use App\Repository\RoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsRepository::class)]
class Rooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $roomNumber = null;

    #[ORM\Column]
    private ?int $numberPlaces = null;

    /**
     * @var Collection<int, Talks>
     */
    #[ORM\OneToMany(targetEntity: Talks::class, mappedBy: 'room')]
    private Collection $talks;

    public function __construct()
    {
        $this->talks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): static
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getNumberPlaces(): ?int
    {
        return $this->numberPlaces;
    }

    public function setNumberPlaces(int $numberPlaces): static
    {
        $this->numberPlaces = $numberPlaces;

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
            $talk->setRoom($this);
        }

        return $this;
    }

    public function removeTalk(Talks $talk): static
    {
        if ($this->talks->removeElement($talk)) {
            // set the owning side to null (unless already changed)
            if ($talk->getRoom() === $this) {
                $talk->setRoom(null);
            }
        }

        return $this;
    }
}
