<?php

namespace App\Controller\Product\Create;

use App\Controller\Product\Create\Form\Form;
use App\Service\Product\Exception\ProductException;
use App\Service\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function __construct(
        private readonly ProductService $productService,
    ) {}

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(Form::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->productService->create($form->getData());

                $this->addFlash('success', 'Продукт успешно создан');

                return $this->redirectToRoute('app_product_show');
            } catch (ProductException $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}