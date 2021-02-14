<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryService
{
    private $manager;
    private $repository;
    private $slugger;

    public function __construct(EntityManagerInterface $manager, CategoryRepository $repository, SluggerInterface $slugger)
    {
        $this->manager = $manager;
        $this->repository = $repository;
        $this->slugger = $slugger;
    }
    
    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        return $this->repository->findAll();
    }
    
    /**
     * @param  Category $category
     * @return void
     */
    public function persist(Category $category): void
    {
        $category->setSlug(strtolower($this->slugger->slug($category->getName())));
        $this->manager->persist($category);
        $this->manager->flush();
    }
    
    /**
     * @param  Category $category
     * @return void
     */
    public function delete(Category $category): void
    {
        $this->manager->remove($category);
        $this->manager->flush();
    }
}
