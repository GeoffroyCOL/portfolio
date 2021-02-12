<?php

namespace App\Controller\Back;

use App\Entity\Category;
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
     * addCategory
     *
     * @Route("/admin/add/category", name="add.category")
     *
     * @param  Request $request
     * @return Response
     */
    public function addCategory(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->persist($form->getData());
            $this->addFlash('success', 'La categorie à bien été ajoutée.');
            return $this->redirectToRoute('list.category');
        }

        return $this->render('back/category/gestionCategory.html.twig', [
            'form'      => $form->createView(),
            'pageTitle' => 'Ajouter une catégorie'
        ]);
    }
    
    /**
     * editCategory
     *
     * @Route("/admin/edit/category/{id}", name="edit.category")
     *
     * @param  Request $request
     * @param  Category $category
     * @return Response
     */
    public function editCategory(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->persist($category);
            $this->addFlash('success', 'La categorie à bien été modfiée.');
            return $this->redirectToRoute('list.category');
        }

        return $this->render('back/category/gestionCategory.html.twig', [
            'form'      => $form->createView(),
            'pageTitle' => 'Modifier une catégorie'
        ]);
    }
    
    /**
     * deleteCategory
     *
     * @Route("/admin/delete/category/{id}", name="delete.category")
     *
     * @param  Category $category
     * @return Response
     */
    public function deleteCategory(Category $category): Response
    {
        $this->categoryService->delete($category);
        $this->addFlash('success', 'La categorie à bien été supprimée.');
        return $this->redirectToRoute('list.category');
    }
}
