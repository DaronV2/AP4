<?php

namespace App\Entity;

use App\Repository\WarehouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarehouseRepository::class)]
class Warehouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $module = null;

    #[ORM\Column(length: 255)]
    private ?string $aisle = null;

    #[ORM\Column(length: 255)]
    private ?string $row_warehouse = null;

    #[ORM\Column]
    private ?int $Section = null;

    /**
     * @var Collection<int, Stocke>
     */
    #[ORM\OneToMany(targetEntity: Stocke::class, mappedBy: 'id_warehouse')]
    private Collection $stockes;

    public function __construct()
    {
        $this->stockes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): static
    {
        $this->module = $module;

        return $this;
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

    public function getRowWarehouse(): ?string
    {
        return $this->row_warehouse;
    }

    public function setRowWarehouse(string $row_warehouse): static
    {
        $this->row_warehouse = $row_warehouse;

        return $this;
    }

    public function getSection(): ?int
    {
        return $this->Section;
    }

    public function setSection(int $Section): static
    {
        $this->Section = $Section;

        return $this;
    }

    /**
     * @return Collection<int, Stocke>
     */
    public function getStockes(): Collection
    {
        return $this->stockes;
    }

    public function addStocke(Stocke $stocke): static
    {
        if (!$this->stockes->contains($stocke)) {
            $this->stockes->add($stocke);
            $stocke->setIdWarehouse($this);
        }

        return $this;
    }

    public function removeStocke(Stocke $stocke): static
    {
        if ($this->stockes->removeElement($stocke)) {
            // set the owning side to null (unless already changed)
            if ($stocke->getIdWarehouse() === $this) {
                $stocke->setIdWarehouse(null);
            }
        }

        return $this;
    }
}
