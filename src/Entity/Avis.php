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
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat_service;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recommendation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_service;

    /**
     * @ORM\OneToOne(targetEntity=Rendezvous::class, mappedBy="avis")
     * @ORM\JoinColumn(nullable=false)

     */
    private $rendezvous;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatService(): ?string
    {
        return $this->etat_service;
    }

    public function setEtatService(string $etat_service): self
    {
        $this->etat_service = $etat_service;

        return $this;
    }

    public function getRecommendation(): ?string
    {
        return $this->recommendation;
    }

    public function setRecommendation(string $recommendation): self
    {
        $this->recommendation = $recommendation;

        return $this;
    }

    public function getDescriptionService(): ?string
    {
        return $this->description_service;
    }

    public function setDescriptionService(string $description_service): self
    {
        $this->description_service = $description_service;

        return $this;
    }

    public function getRendezvous(): ?Rendezvous
    {
        return $this->rendezvous;
    }

    public function setRendezvous(Rendezvous $rendezvous): self
    {
        // set the owning side of the relation if necessary
        if ($rendezvous->getAvis() !== $this) {
            $rendezvous->setAvis($this);
        }

        $this->rendezvous = $rendezvous;

        return $this;
    }
}
