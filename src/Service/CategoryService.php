<?php

namespace App\Service;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{
    private $manager;
    private $repository;

    public function __construct(EntityManagerInterface $manager, CategoryRepository $repository)
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
