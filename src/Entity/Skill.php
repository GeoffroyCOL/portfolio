<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SkillRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 * @UniqueEntity(
 *      fields={"name"},
 *      message="Cette compétence existe déjà."
 * )
 */
class Skill
{
    const LEVEL = [
        'junior', 'confirmé', 'sénior'
    ];

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
     *      message="Le nom de la compétence ne peut pas être vide !"
     * )
     *
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le nom de la compétence doit être supérieur à {{ limit }} charactères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(
     *      message="La couleur associée ne peut pas être vide !"
     * )
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(
     *      message="L'icon associé ne peut pas être vide !"
     * )
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(
     *      message="Le niveau associé ne peut pas être vide !"
     * )
     *
     * @Assert\Choice(
     *      choices=Skill::LEVEL, message="Vous ne pouvez pas choisir cette valeur."
     * )
     */
    private $level;
    
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
     * getColor
     *
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }
    
    /**
     * setColor
     *
     * @param  string $color
     * @return self
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

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
    
    /**
     * getLevel
     *
     * @return string|null
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }
    
    /**
     * setLevel
     *
     * @param  string $level
     * @return self
     */
    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }
}
