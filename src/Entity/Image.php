<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "La description de l'image doit être supérieur à {{ limit }} charactères."
     * )
     */
    private $alt;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="project_images", fileNameProperty="image")
     * @var File
     *
     * @Assert\Image(
     *      minRatio = 1,
     *      minRatioMessage = "Cette image doit avoir un ratio minimum de {{ min_ratio }} pour {{ ratio }} actuellement"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    
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
    public function getAlt(): ?string
    {
        return $this->alt;
    }
    
    /**
     * @param  string|null $alt
     * @return self
     */
    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;
        return $this;
    }
    
    /**
     * @param  File|null $image
     * @return void
     */
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }
    
    public function getImageFile()
    {
        return $this->imageFile;
    }
    
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    public function getImage()
    {
        return $this->image;
    }
}
