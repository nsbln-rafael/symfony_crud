<?php

namespace App\Controller\Product\View;

use App\Service\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
    ) {}

    public function __invoke(Request $request, int $id): Response
    {
        $product = $this->productRepository->getById($id);
        if (is_null($product)) {
            $this->addFlash('danger', 'Продукт не найден');

            return  $this->redirectToRoute('app_product_show');
        }

        return $this->render(
            'product/view.html.twig',
            [
                'product' => $product,
            ]
        );
    }
}