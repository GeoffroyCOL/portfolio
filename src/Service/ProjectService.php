<?php

namespace App\Service;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProjectService
{
    private $manager;
    private $repository;
    private $slugger;
    private $security;

    public function __construct(EntityManagerInterface $manager, ProjectRepository $repository, Security $security, SluggerInterface $slugger)
    {
        $this->manager = $manager;
        $this->repository = $repository;
        $this->security = $security;
        $this->slugger = $slugger;
    }
    
    /**
     * getAll
     *
     * @return array|null
     */
    public function getAll(): ?array
    {
        return $this->repository->findAll();
    }
    
    /**
     * add
     *
     * @param  Project $project
     * @return void
     */
    public function add(Project $project): void
    {
        $project->setAutor($this->security->getUser());
        $project->setSlug(strtolower($this->slugger->slug($project->getTitle())));

        $this->manager->persist($project);
        $this->manager->flush();
    }
    
    /**
     * edit
     *
     * @param  Project $project
     * @return void
     */
    public function edit(Project $project): void
    {
        $project->setSlug(strtolower($this->slugger->slug($project->getTitle())));
        $this->manager->flush();
    }
}