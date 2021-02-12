<?php

namespace App\Controller\Back;

use App\Service\CategoryService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * CategoryController
 *
 * @Security("is_granted('ROLE_SUPER_ADMIN')", statusCode=403, message="vous ne pouvez pas accéder à cette partie !")
 */
class CategoryController extends AbstractController
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("/admin/categories", name="list.category")
     *
     * @return Response
     */
    public function listCategory(): Response
    {
        return $this->render('back/category/listCategories.html.twig', [
            'categories' => $this->categoryService->getAll()
        ]);
    }
}
