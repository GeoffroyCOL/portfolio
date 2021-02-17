<?php

namespace App\Controller\Ajax;

use App\Entity\Project;
use App\Entity\Category;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    
    /**
     * @Route("/ajax/projects/{compteur}", name="ajax.project", methods={"get"})
     * @return JsonResponse
     */
    public function loadProjects(int $compteur): Response
    {
        $projects = $this->projectService->getProjectsByPagination(Project::NUMBER, Project::NUMBER * $compteur);
        $number = $this->projectService->getNumber() - Project::NUMBER * (1 + $compteur);

        return new JsonResponse([
            'projects'  => $projects,
            'number'    => $number
        ]);
    }
}
