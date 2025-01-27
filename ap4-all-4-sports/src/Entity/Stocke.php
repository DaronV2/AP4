<?php

namespace App\Entity;

use App\Repository\StockeRepository;
use Doctrine\ORM\Mapping as ORM;

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
}
