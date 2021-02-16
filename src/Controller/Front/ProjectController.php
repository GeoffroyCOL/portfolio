<?php

namespace App\Controller\Front;

use App\Entity\Project;
use App\Service\SocialService;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    private $projectService;
    private $socialService;
    private $categoryService;

    public function __construct(ProjectService $projectService, SocialService $socialService)
    {
        $this->projectService = $projectService;
        $this->socialService = $socialService;
    }

    /**
     * @Route("/projet/{slug}", name="single.project")
     * @param  Project $project
     * @return Response 
     */
    public function show(Project $project): Response
    {
        $categories = $project->getCategory()->toArray();

        

        return $this->render('front/projects/single.html.twig', [
            'project'               => $project,
            'socials'               => $this->socialService->getAll(),
            'singleProject'         => true
        ]);
    }
}
