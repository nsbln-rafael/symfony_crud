<?php

namespace App\Controller\Product\Edit;

use App\Controller\Product\Edit\Dto\ProductEditData;
use App\Controller\Product\Edit\Form\Form;
use App\Service\Product\Exception\ProductException;
use App\Service\Product\ProductRepositoryInterface;
use App\Service\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function __construct(
        private readonly ProductService             $productService,
        private readonly ProductRepositoryInterface $productRepository,
    ) {}

    public function __invoke(Request $request, int $id): Response
    {
        $product = $this->productRepository->getById($id);
        if (is_null($product)) {
            $this->addFlash('danger', 'Продукт не найден');

            return  $this->redirectToRoute('app_product_show');
        }

        $form = $this->createForm(Form::class, new ProductEditData($product));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->productService->edit($form->getData());

                $this->addFlash('success', 'Продукт успешно обновлён');

                return $this->redirectToRoute('app_product_show');
            } catch (ProductException $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}