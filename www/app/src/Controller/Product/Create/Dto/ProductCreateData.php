<?php

namespace App\Controller\Product\Create\Dto;

use App\Service\Product\Contract\ProductCreateDataInterface;

class ProductCreateData implements ProductCreateDataInterface
{
    private ?string $name  = null;
    private ?string $price = null;

    public function getFormName(): ?string
    {
        return $this->name;
    }

    public function setFormName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFormPrice(): ?string
    {
        return $this->price;
    }

    public function setFormPrice(?string $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}