<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank
     *
     */
    private $description;

     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Only jpeg or png are allowed."
     * )
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     * @Assert\NotBlank
     */
    private $IDProd;

    /**
     * @ORM\Column(name="type", type="string", columnDefinition="enum('Standard', 'Silver' ,'Gold', 'Premium')")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="offp")
     */
    private $prodoff;

    

    public function __construct()
    {
        $this->IDProd = new ArrayCollection();
        $this->prodoff = new ArrayCollection();
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage( $image)
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, produit>
     */
    public function getProdoff(): Collection
    {
        return $this->prodoff;
    }

    public function addProdoff(produit $prodoff): self
    {
        if (!$this->prodoff->contains($prodoff)) {
            $this->prodoff[] = $prodoff;
        }

        return $this;
    }

    public function removeProdoff(produit $prodoff): self
    {
        $this->prodoff->removeElement($prodoff);

        return $this;
    }

   
}
