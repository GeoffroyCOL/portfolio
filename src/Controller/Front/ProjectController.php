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
        $projectsByCategory = [];

        //Récupération des catégories du project
        $categories = $project->getCategory()->toArray();

        //Récupération des différents projets selon les catégories
        foreach($categories as $category) {
            foreach($category->getProjects() as $projectCategory) {
                if ($project !== $projectCategory && !in_array($projectCategory, $projectsByCategory)) {
                    $projectsByCategory[] = $projectCategory;
                }
            }
        }

        return $this->render('front/projects/single.html.twig', [
            'project'               => $project,
            'socials'               => $this->socialService->getAll(),
            'singleProject'         => true,
            'projectsByCategory'    => $projectsByCategory
        ]);
    }
}
