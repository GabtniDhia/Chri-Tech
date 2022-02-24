<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez le nom du catégorie")
     */
    private $Nom_Cat;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez le type")
     */
    private $Type_Cat;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="cle_cat")
     */
    private $cle_prod;



    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->cle_prod = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCat(): ?string
    {
        return $this->Nom_Cat;
    }

    public function setNomCat(string $Nom_Cat): self
    {
        $this->Nom_Cat = $Nom_Cat;

        return $this;
    }

    public function getTypeCat(): ?string
    {
        return $this->Type_Cat;
    }

    public function setTypeCat(string $Type_Cat): self
    {
        $this->Type_Cat = $Type_Cat;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getCleProd(): Collection
    {
        return $this->cle_prod;
    }

    public function addCleProd(Produit $cleProd): self
    {
        if (!$this->cle_prod->contains($cleProd)) {
            $this->cle_prod[] = $cleProd;
            $cleProd->setCleCat($this);
        }

        return $this;
    }

    public function removeCleProd(Produit $cleProd): self
    {
        if ($this->cle_prod->removeElement($cleProd)) {
            // set the owning side to null (unless already changed)
            if ($cleProd->getCleCat() === $this) {
                $cleProd->setCleCat(null);
            }
        }

        return $this;
    }






}
