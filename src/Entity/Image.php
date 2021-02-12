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
     *      minRatioMessage = "Cette image doit avoir un ratio minimum de {{ min_ratio }} pour {{ ratio }} actuellement",
     *      mimeTypes = "jpeg",
     *      mimeTypesMessage = "Cette image doit avoir une extension en jpeg"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    
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
     * getAlt
     *
     * @return string|null
     */
    public function getAlt(): ?string
    {
        return $this->alt;
    }
    
    /**
     * setAlt
     *
     * @param  string|null $alt
     * @return self
     */
    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }
    
    /**
     * setImageFile
     *
     * @param  File|null $image
     * @return void
     */
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    
    /**
     * getImageFile
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
    
    /**
     * setImage
     *
     * @param  string $image
     * @return void
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }
    
    /**
     * getImage
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
