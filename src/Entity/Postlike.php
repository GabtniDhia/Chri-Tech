<?php

namespace App\Entity;

use App\Repository\PostlikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostlikeRepository::class)
 */
class Postlike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Blog::class, inversedBy="likes")
     */
    private $blogL;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="likes")
     */
    private $userL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogL(): ?Blog
    {
        return $this->blogL;
    }

    public function setBlogL(?Blog $blogL): self
    {
        $this->blogL = $blogL;

        return $this;
    }

    public function getUserL(): ?user
    {
        return $this->userL;
    }

    public function setUserL(?user $userL): self
    {
        $this->userL = $userL;

        return $this;
    }
}
