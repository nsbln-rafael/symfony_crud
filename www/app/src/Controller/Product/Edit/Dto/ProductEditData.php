<?php

namespace App\Controller\Product\Edit\Dto;

use App\Entity\Product;
use App\Service\Product\Contract\ProductEditDataInterface;

class ProductEditData implements ProductEditDataInterface
{
    private int    $id;
    private string $name;
    private string $price;

    public function __construct(Product $product)
    {
        $this->id    = $product->getId();
        $this->name  = $product->getName();
        $this->price = $product->getPrice();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}