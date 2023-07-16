<?php

namespace App\Service\Product\Contract;

interface ProductCreateDataInterface
{
    public function getName(): string;
    public function getPrice(): string;
}