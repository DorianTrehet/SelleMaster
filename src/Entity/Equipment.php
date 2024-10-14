<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastMovement = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Condition $stat = null;

    /**
     * @var Collection<int, History>
     */
    #[ORM\OneToMany(targetEntity: History::class, mappedBy: 'equipment')]
    private Collection $histories;

    /**
     * @var Collection<int, Movement>
     */
    #[ORM\OneToMany(targetEntity: Movement::class, mappedBy: 'equipment')]
    private Collection $movements;

    /**
     * @var Collection<int, Repair>
     */
    #[ORM\OneToMany(targetEntity: Repair::class, mappedBy: 'equipment')]
    private Collection $repairs;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
        $this->movements = new ArrayCollection();
        $this->repairs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getLastMovement(): ?\DateTimeInterface
    {
        return $this->lastMovement;
    }

    public function setLastMovement(?\DateTimeInterface $lastMovement): static
    {
        $this->lastMovement = $lastMovement;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getStat(): ?Condition
    {
        return $this->stat;
    }

    public function setStat(?Condition $stat): static
    {
        $this->stat = $stat;

        return $this;
    }

    /**
     * @return Collection<int, History>
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): static
    {
        if (!$this->histories->contains($history)) {
            $this->histories->add($history);
            $history->setEquipment($this);
        }

        return $this;
    }

    public function removeHistory(History $history): static
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getEquipment() === $this) {
                $history->setEquipment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Movement>
     */
    public function getMovements(): Collection
    {
        return $this->movements;
    }

    public function addMovement(Movement $movement): static
    {
        if (!$this->movements->contains($movement)) {
            $this->movements->add($movement);
            $movement->setEquipment($this);
        }

        return $this;
    }

    public function removeMovement(Movement $movement): static
    {
        if ($this->movements->removeElement($movement)) {
            // set the owning side to null (unless already changed)
            if ($movement->getEquipment() === $this) {
                $movement->setEquipment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Repair>
     */
    public function getRepairs(): Collection
    {
        return $this->repairs;
    }

    public function addRepair(Repair $repair): static
    {
        if (!$this->repairs->contains($repair)) {
            $this->repairs->add($repair);
            $repair->setEquipment($this);
        }

        return $this;
    }

    public function removeRepair(Repair $repair): static
    {
        if ($this->repairs->removeElement($repair)) {
            // set the owning side to null (unless already changed)
            if ($repair->getEquipment() === $this) {
                $repair->setEquipment(null);
            }
        }

        return $this;
    }
}
