<?php

namespace App\Entity;

use App\Repository\CarteFideliteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarteFideliteRepository::class)
 */
class CarteFidelite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbPoints;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateExpiration;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPoints(): ?int
    {
        return $this->NbPoints;
    }

    public function setNbPoints(?int $NbPoints): self
    {
        $this->NbPoints = $NbPoints;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->DateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $DateExpiration): self
    {
        $this->DateExpiration = $DateExpiration;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->IdUser;
    }

    public function setIdUser(int $IdUser): self
    {
        $this->IdUser = $IdUser;

        return $this;
    }
}
