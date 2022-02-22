<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez la reference du produit")
     */
    private $Ref_Prod;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez le nom du produit")
     */
    private $Nom_Prod;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez la description du produit")
     */
    private $Descri_Prod;

    /**
     * @ORM\Column(type="float")
     *@Assert\NotBlank(message="Entrez le prix unitaire du produit")
     */
    private $PrixUnitHT_Prod;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *@Assert\NotBlank(message="Entrez la quantité du produit")
     */
    private $QteStock_Prod;

    /**
     * @ORM\Column(type="blob", nullable=true)
     *@Assert\NotBlank(message="Entrez une image du produit")
     */
    private $Image_Prod;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank(message="Entrez les details du produit")
     */
    private $Detail_Prod;

    /**
     * @ORM\Column(type="float")
     *@Assert\NotBlank(message="Entrez le prixTTC")
     */
    private $PrixTTC_Prod;

    /**
     * @ORM\Column(type="float")
     *@Assert\NotBlank(message="Entrez le prix TVA")
     */
    private $PrixTVA_Prod;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefProd(): ?string
    {
        return $this->Ref_Prod;
    }

    public function setRefProd(string $Ref_Prod): self
    {
        $this->Ref_Prod = $Ref_Prod;

        return $this;
    }

    public function getNomProd(): ?string
    {
        return $this->Nom_Prod;
    }

    public function setNomProd(string $Nom_Prod): self
    {
        $this->Nom_Prod = $Nom_Prod;

        return $this;
    }

    public function getDescriProd(): ?string
    {
        return $this->Descri_Prod;
    }

    public function setDescriProd(string $Descri_Prod): self
    {
        $this->Descri_Prod = $Descri_Prod;

        return $this;
    }

    public function getPrixUnitHTProd(): ?float
    {
        return $this->PrixUnitHT_Prod;
    }

    public function setPrixUnitHTProd(float $PrixUnitHT_Prod): self
    {
        $this->PrixUnitHT_Prod = $PrixUnitHT_Prod;

        return $this;
    }

    public function getQteStockProd(): ?int
    {
        return $this->QteStock_Prod;
    }

    public function setQteStockProd(?int $QteStock_Prod): self
    {
        $this->QteStock_Prod = $QteStock_Prod;

        return $this;
    }

    public function getImageProd()
    {
        return $this->Image_Prod;
    }

    public function setImageProd($Image_Prod): self
    {
        $this->Image_Prod = $Image_Prod;

        return $this;
    }

    public function getDetailProd(): ?string
    {
        return $this->Detail_Prod;
    }

    public function setDetailProd(string $Detail_Prod): self
    {
        $this->Detail_Prod = $Detail_Prod;

        return $this;
    }

    public function getPrixTTCProd(): ?float
    {
        return $this->PrixTTC_Prod;
    }

    public function setPrixTTCProd(float $PrixTTC_Prod): self
    {
        $this->PrixTTC_Prod = $PrixTTC_Prod;

        return $this;
    }

    public function getPrixTVAProd(): ?float
    {
        return $this->PrixTVA_Prod;
    }

    public function setPrixTVAProd(float $PrixTVA_Prod): self
    {
        $this->PrixTVA_Prod = $PrixTVA_Prod;

        return $this;
    }
}
