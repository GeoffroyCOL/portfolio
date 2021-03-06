<?php

namespace App\Controller\Back;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Form\EditProjectType;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_SUPER_ADMIN')", statusCode=403, message="vous ne pouvez pas accéder à cette partie !")
 */
class ProjectController extends AbstractController
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @Route("/admin/projects", name="list.project")
     * @return Response
     */
    public function listProjects(): Response
    {
        return $this->render('back/project/listProjects.html.twig', [
            'projects'      => $this->projectService->getAll(),
            'active_page'   => 'project'
        ]);
    }
    
    /**
     * @Route("/admin/add/project", name="add.project")
     * @param  Request $request
     * @return Response
     */
    public function addProject(Request $request): Response
    {
        $form = $this->createForm(ProjectType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->add($form->getData());
            $this->addFlash('success', 'Le projet à bien été ajouté.');
            return $this->redirectToRoute('list.project');
        }

        return $this->render('back/project/gestionProject.html.twig', [
            'form'      => $form->createView(),
            'action'    => 'Ajouter'
        ]);
    }
    
    /**
     * @Route("/admin/edit/project/{id}", name="edit.project")
     * @param  Request $request
     * @param  Project $project
     * @return Response
     */
    public function editProject(Request $request, Project $project): Response
    {
        $form = $this->createForm(EditProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->projectService->edit($form->getData());
            $this->addFlash('success', 'Le projet à bien été modifié.');
            return $this->redirectToRoute('list.project');
        }

        return $this->render('back/project/gestionProject.html.twig', [
            'form'      => $form->createView(),
            'action'    => 'Modifier',
            'project'   => $project
        ]);
    }
    
    /**
     * @Route("/admin/delete/project/{id}", name="delete.project")
     * @param  Project $project
     * @return Response
     */
    public function deleteProject(Project $project): Response
    {
        $this->projectService->delete($project);
        $this->addFlash('success', 'Le projet à bien été supprimé.');
        return $this->redirectToRoute('list.project');
    }
}
