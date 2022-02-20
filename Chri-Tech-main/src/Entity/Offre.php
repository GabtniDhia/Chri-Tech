<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     */
    private $IDProd;

    public function __construct()
    {
        $this->IDProd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getIDProd(): Collection
    {
        return $this->IDProd;
    }

    public function addIDProd(Produit $iDProd): self
    {
        if (!$this->IDProd->contains($iDProd)) {
            $this->IDProd[] = $iDProd;
        }

        return $this;
    }

    public function removeIDProd(Produit $iDProd): self
    {
        $this->IDProd->removeElement($iDProd);

        return $this;
    }
}
