<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 */
class Avis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_avis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Etat_Service;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Recommendation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DescriptionService;





    public function getId(): ?int
    {
        return $this->id_avis;
    }

    public function getEtatService(): ?string
    {
        return $this->Etat_Service;
    }

    public function setEtatService(string $Etat_Service): self
    {
        $this->Etat_Service = $Etat_Service;

        return $this;
    }

    public function getRecommendation(): ?string
    {
        return $this->Recommendation;
    }

    public function setRecommendation(string $Recommendation): self
    {
        $this->Recommendation = $Recommendation;

        return $this;
    }

    public function getDescriptionService(): ?string
    {
        return $this->DescriptionService;
    }

    public function setDescriptionService(string $DescriptionService): self
    {
        $this->DescriptionService = $DescriptionService;

        return $this;
    }



}
