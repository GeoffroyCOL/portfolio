<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SocialRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=SocialRepository::class)
 * @UniqueEntity(
 *      fields={"name"},
 *      message="Ce réseau social existe déjà."
 * )
 */
class Social
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * 
     * @Assert\NotBlank(
     *      message="Le nom du réseau social ne peut pas être vide !"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Url(
     *    message = "L'url du projet n'est pas valide.",
     * )
     * 
     * @Assert\NotBlank(
     *      message="L'url du réseau social ne peut pas être vide !"
     * )
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=50)
     * 
     * @Assert\NotBlank(
     *      message="L'icon du réseau social ne peut pas être vide !"
     * )
     */
    private $icon;
    
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
     * getName
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * setName
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * getUrl
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
    
    /**
     * setUrl
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
    
    /**
     * getIcon
     *
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }
    
    /**
     * setIcon
     *
     * @param  string $icon
     * @return self
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
