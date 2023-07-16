<?php

namespace App\Controller\Product\Delete\Dto;

use App\Entity\Product;
use App\Service\Product\Contract\ProductIdentificationDataInterface;

class ProductDeleteData implements ProductIdentificationDataInterface
{
    private int $id;

    public function __construct(Product $product) {
        $this->id = $product->getId();
    }

    public function getId(): int
    {
        return $this->id;
    }
}