<?php

namespace App\Controller\Ajax;

use App\Entity\Project;
use App\Entity\Category;
use App\Service\ContactService;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    private $projectService;
    private $contactService;

    public function __construct(ProjectService $projectService, ContactService $contactService)
    {
        $this->projectService = $projectService;
        $this->contactService = $contactService;
    }
    
    /**
     * @Route("/ajax/projects/{compteur}", name="ajax.project", methods={"post"})
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
    
    /**
     * @Route("/ajax/contact", name="ajax.contact", methods={"post"})
     * @return JsonResponse
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $contact = [
            'name' => $request->request->get('name'),
            'lastname' => $request->request->get('lastname'),
            'email' => $request->request->get('email'),
            'message' => $request->request->get('message'),
        ];

        $errors = $this->contactService->sendMessage($contact);

        $message = empty($errors) ? "Votre message à bien été envoyé" : "Votre message n'a pas pu être envoyé";
        $status = empty($errors) ? "success" : "danger";

        return new JsonResponse([
            'errors'    => $errors,
            'message'   => $message,
            'status'    => $status
        ]);
    }
}
