<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class)
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $featured;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }
    
    /**
     * getId
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * getTitle
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * setTitle
     *
     * @param  string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    
    /**
     * getSlug
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    /**
     * setSlug
     *
     * @param  string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    
    /**
     * getContent
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * setContent
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
    
    /**
     * getCreatedAt
     *
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    
    /**
     * setCreatedAt
     *
     * @param  DateTimeInterface $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
    /**
     * getWebsite
     *
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }
    
    /**
     * setWebsite
     *
     * @param  string|null $website
     * @return self
     */
    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }
    
    /**
     * addCategory
     *
     * @param  Category $category
     * @return self
     */
    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }
    
    /**
     * removeCategory
     *
     * @param  Category $category
     * @return self
     */
    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }
    
    /**
     * getFeatured
     *
     * @return Image|null
     */
    public function getFeatured(): ?Image
    {
        return $this->featured;
    }
    
    /**
     * setFeatured
     *
     * @param  Image $featured
     * @return self
     */
    public function setFeatured(Image $featured): self
    {
        $this->featured = $featured;

        return $this;
    }
    
    /**
     * getAutor
     *
     * @return User|null
     */
    public function getAutor(): ?User
    {
        return $this->autor;
    }
    
    /**
     * setAutor
     *
     * @param  User|null $autor
     * @return self
     */
    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

        return $this;
    }
    
    /**
     * getGithub
     *
     * @return string|null
     */
    public function getGithub(): ?string
    {
        return $this->github;
    }
    
    /**
     * setGithub
     *
     * @param  string|null $github
     * @return self
     */
    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }
}
