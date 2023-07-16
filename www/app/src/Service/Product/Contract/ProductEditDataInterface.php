<?php

namespace App\Service\Product\Contract;

interface ProductEditDataInterface extends ProductIdentificationDataInterface
{
    public function getName(): string;
    public function getPrice(): string;
}