<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $Nom_Cat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type_Cat;

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
}
