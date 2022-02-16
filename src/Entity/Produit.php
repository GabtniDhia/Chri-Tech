<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $RefProd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomProd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DescProd;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixUnitHT;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteStock;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImageProd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DetailProd;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixTTC;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixTVA;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefProd(): ?string
    {
        return $this->RefProd;
    }

    public function setRefProd(string $RefProd): self
    {
        $this->RefProd = $RefProd;

        return $this;
    }

    public function getNomProd(): ?string
    {
        return $this->NomProd;
    }

    public function setNomProd(string $NomProd): self
    {
        $this->NomProd = $NomProd;

        return $this;
    }

    public function getDescProd(): ?string
    {
        return $this->DescProd;
    }

    public function setDescProd(string $DescProd): self
    {
        $this->DescProd = $DescProd;

        return $this;
    }

    public function getPrixUnitHT(): ?float
    {
        return $this->PrixUnitHT;
    }

    public function setPrixUnitHT(float $PrixUnitHT): self
    {
        $this->PrixUnitHT = $PrixUnitHT;

        return $this;
    }

    public function getQteStock(): ?int
    {
        return $this->qteStock;
    }

    public function setQteStock(int $qteStock): self
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    public function getImageProd(): ?string
    {
        return $this->ImageProd;
    }

    public function setImageProd(string $ImageProd): self
    {
        $this->ImageProd = $ImageProd;

        return $this;
    }

    public function getDetailProd(): ?string
    {
        return $this->DetailProd;
    }

    public function setDetailProd(string $DetailProd): self
    {
        $this->DetailProd = $DetailProd;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->PrixTTC;
    }

    public function setPrixTTC(float $PrixTTC): self
    {
        $this->PrixTTC = $PrixTTC;

        return $this;
    }

    public function getPrixTVA(): ?int
    {
        return $this->PrixTVA;
    }

    public function setPrixTVA(int $PrixTVA): self
    {
        $this->PrixTVA = $PrixTVA;

        return $this;
    }
}
