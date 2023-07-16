<?php

namespace App\Controller\Product\Delete;

use App\Controller\Product\Delete\Dto\ProductDeleteData;
use App\Service\Product\Exception\ProductException;
use App\Service\Product\ProductRepositoryInterface;
use App\Service\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductService             $productService,
    ) {}

    public function __invoke(Request $request, int $id): Response
    {
        $product = $this->productRepository->getById($id);
        if (is_null($product)) {
            $this->addFlash('danger', 'Продукт не найден');

            return  $this->redirectToRoute('app_product_show');
        }

        try {
            $this->productService->delete(new ProductDeleteData($product));

            $this->addFlash('success', 'Продукт успешно удалён');
        } catch (ProductException $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('app_product_show');
    }
}