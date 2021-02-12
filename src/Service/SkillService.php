<?php

namespace App\Service;

use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;

class SkillService
{
    private $manager;
    private $repository;

    public function __construct(EntityManagerInterface $manager, SkillRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
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
}
