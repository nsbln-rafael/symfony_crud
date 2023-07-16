<?php

namespace App\Controller\Product\Show;

use App\Service\Product\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
    ) {}

    public function __invoke(Request $request): Response
    {
        $products = $this->productRepository->getAll();

        return $this->render(
            'product/show.html.twig',
            [
                'products' => $products,
            ]
        );
    }
}