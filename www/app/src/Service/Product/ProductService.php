<?php

namespace App\Service\Product;

use App\Entity\Product;
use App\Service\Product\Contract\ProductCreateDataInterface;
use App\Service\Product\Contract\ProductEditDataInterface;
use App\Service\Product\Contract\ProductIdentificationDataInterface;
use App\Service\Product\Exception\ProductException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;

class ProductService
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        private readonly EntityManagerInterface     $entityManager,
        private readonly ProductRepositoryInterface $productRepository,
    ) {}

    /**
     * @throws ProductException
     */
    public function create(ProductCreateDataInterface $data): void
    {
        if ($this->productRepository->getByName($data->getName())) {
            throw new ProductException('Продукт с таким именем уже создан');
        }

        $product = new Product();
        $product->setName($data->getName());
        $product->setPrice($data->getPrice());

        try {
            $this->entityManager->persist($product);
            $this->entityManager->flush($product);
        } catch (ORMException $exception) {
            throw new ProductException('Ошибка сохранения', 0, $exception);
        }
    }

    /**
     * @throws ProductException
     */
    public function edit(ProductEditDataInterface $data): void
    {
        $product = $this->productRepository->getById($data->getId());
        if (is_null($product)) {
            throw new ProductException('Продукт не найден');
        }

        $productByName = $this->productRepository->getByName($data->getName());
        if ($productByName && $product->getId() !== $productByName->getId()) {
            throw new ProductException('Продукт с таким именем уже создан');
        }

        $product->setName($data->getName());
        $product->setPrice($data->getPrice());

        try {
            $this->entityManager->flush($product);
        } catch (ORMException $exception) {
            throw new ProductException('Ошибка сохранения', 0, $exception);
        }
    }

    /**
     * @throws ProductException
     */
    public function delete(ProductIdentificationDataInterface $data): void
    {
        $product = $this->productRepository->getById($data->getId());
        if (is_null($product)) {
            throw new ProductException('Продукт не найден');
        }

        try {
            $this->entityManager->remove($product);
            $this->entityManager->flush($product);
        } catch (ORMException $exception) {
            throw new ProductException('Ошибка удаления', 0, $exception);
        }
    }
}