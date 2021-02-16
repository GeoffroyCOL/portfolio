<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @UniqueEntity(
 *      fields={"title"},
 *      message="Ce projet existe déjà."
 * )
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
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(
     *      message="Le titre du projet ne peut pas être vide !"
     * )
     *
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Le titre du projet doit être supérieur à {{ limit }} charactères."
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank(
     *      message="Le contenue du projet ne peut pas être vide !"
     * )
     *
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Le contenue du projet doit être supérieur à {{ limit }} charactères."
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Url(
     *    message = "L'url du projet n'est pas valide.",
     * )
     */
    private $website;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Valid
     */
    private $featured;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Url(
     *    message = "L'url du repository n'est pas valide.",
     * )
     */
    private $github;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="projects")
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }
    
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * @param  string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    /**
     * @param  string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    
    /**
     * @param  DateTimeInterface $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }
    
    /**
     * @param  string|null $website
     * @return self
     */
    public function setWebsite(?string $website): self
    {
        $this->website = $website;
        return $this;
    }
    
    /**
     * @return Image|null
     */
    public function getFeatured(): ?Image
    {
        return $this->featured;
    }
    
    /**
     * @param  Image $featured
     * @return self
     */
    public function setFeatured(Image $featured): self
    {
        $this->featured = $featured;
        return $this;
    }
    
    /**
     * @return User|null
     */
    public function getAutor(): ?User
    {
        return $this->autor;
    }
    
    /**
     * @param  User|null $autor
     * @return self
     */
    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getGithub(): ?string
    {
        return $this->github;
    }
    
    /**
     * @param  string|null $github
     * @return self
     */
    public function setGithub(?string $github): self
    {
        $this->github = $github;
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
     * @param  Category $category
     * @return self
     */
    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);
        return $this;
    }
}
