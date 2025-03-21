<?php

namespace App\Entity;

use Aisle;
use App\Repository\StockeRepository;
use Doctrine\ORM\Mapping as ORM;
use Modules;

#[ORM\Entity(repositoryClass: StockeRepository::class)]
class Stocke
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'stockes')]
    private ?Products $reference_product = null;

    #[ORM\ManyToOne(inversedBy: 'stockes')]
    private ?Warehouse $id_warehouse = null;

    #[ORM\Column(length: 255, type: 'string', enumType: Modules::class)]
    private ?Modules $module = null;

    #[ORM\Column(length: 255, type: 'string', enumType: Aisle::class)]
    private ?Aisle $aislse = null;

    #[ORM\Column(length: 255)]
    private ?string $rowWarehouse = null;

    #[ORM\Column(length: 255)]
    private ?string $section = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getReferenceProduct(): ?Products
    {
        return $this->reference_product;
    }

    public function setReferenceProduct(?Products $reference_product): static
    {
        $this->reference_product = $reference_product;

        return $this;
    }

    public function getIdWarehouse(): ?Warehouse
    {
        return $this->id_warehouse;
    }

    public function setIdWarehouse(?Warehouse $id_warehouse): static
    {
        $this->id_warehouse = $id_warehouse;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module->value;
    }

    public function setModule(Modules $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getAislse(): ?string
    {
        return $this->aislse->value;
    }

    public function setAislse(Aisle $aislse): static
    {
        $this->aislse = $aislse;

        return $this;
    }

    public function getRowWarehouse(): ?string
    {
        return $this->rowWarehouse;
    }

    public function setRowWarehouse(string $rowWarehouse): static
    {
        $this->rowWarehouse = $rowWarehouse;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): static
    {
        $this->section = $section;

        return $this;
    }
}
