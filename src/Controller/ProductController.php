<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product.index', methods: ['GET'])]
    public function index(ProductRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $products = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1)
        );

        return $this->render('pages/product/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/product/add', name: 'product.createProduct', methods: ['GET', 'POST'])]
    public function createProduct(): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        return $this->render('pages/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
