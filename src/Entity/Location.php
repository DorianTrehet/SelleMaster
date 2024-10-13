<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $aisle = null;

    #[ORM\Column(length: 255)]
    private ?string $shelf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAisle(): ?string
    {
        return $this->aisle;
    }

    public function setAisle(string $aisle): static
    {
        $this->aisle = $aisle;

        return $this;
    }

    public function getShelf(): ?string
    {
        return $this->shelf;
    }

    public function setShelf(string $shelf): static
    {
        $this->shelf = $shelf;

        return $this;
    }
}
