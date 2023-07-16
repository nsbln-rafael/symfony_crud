<?php

namespace App\Service\Product;

use App\Entity\Product;

interface ProductRepositoryInterface
{
    /**
     * @return Product[]
     */
    public function getAll(): array;

    public function getById(int $id): ?Product;

    public function getByName(string $name): ?Product;
}