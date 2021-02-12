<?php

namespace App\Controller\Back;

use App\Form\CategoryType;
use App\Service\CategoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    
    /**
     * @Route("/admin/add/category", name="add.category")
     *
     * @return Response
     */
    public function addCategory(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->add($form->getData());
            $this->addFlash('success', 'La categorie à bien été ajoutée.');
            return $this->redirectToRoute('list.category');
        }

        return $this->render('back/category/gestionCategory.html.twig', [
            'form'      => $form->createView(),
            'pageTitle' => 'Ajouter une catégorie'
        ]);
    }
}
