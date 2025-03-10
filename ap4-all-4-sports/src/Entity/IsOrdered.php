<?php

namespace App\Entity;

use App\Repository\IsOrderedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IsOrderedRepository::class)]
class IsOrdered
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\OneToOne(inversedBy: 'isOrdered', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $command = null;

    #[ORM\OneToOne(inversedBy: 'isOrdered', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product = null;

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

    public function getCommand(): ?Order
    {
        return $this->command;
    }

    public function setCommand(Order $command): static
    {
        $this->command = $command;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(Products $product): static
    {
        $this->product = $product;

        return $this;
    }
}
