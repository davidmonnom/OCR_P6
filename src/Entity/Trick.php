<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\ORM\Mapping as ORM;
use  Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=TrickRepository::class)
 */
class Trick
{
    public const groups = [
        1 => "grabs",
        2 => "rotation",
        3 => "flips"
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trickgroup;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    public function __construct(){
        $this->creation_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function getSlug(): ?string
    {
        return $slugify = (new Slugify())->slugify($this->name);
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTrickgroup(): ?string
    {
        return self::groups[$this->trickgroup];
    }

    public function setTrickgroup(?string $trickgroup): self
    {
        $this->trickgroup = $trickgroup;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }
}
