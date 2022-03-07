<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=RendezvousRepository::class)
 */
class Rendezvous
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $service;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\DateTime")
     * @var string A "Y-m-d H:i:s" formatted value
     * @Assert\GreaterThan("today")
     */
    private $date_rendezvous;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $description_rendezvous;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "le numero est invalide verifer la longeur",
     *      maxMessage = "le numero est invalide verifer la longeur"
     * )
     */
    private $telephonenum;

    /**
     * @ORM\OneToOne(targetEntity=Avis::class, inversedBy="rendezvous")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $avis;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $adressrend;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getDateRendezvous(): ?\DateTimeInterface
    {
        return $this->date_rendezvous;
    }

    public function setDateRendezvous(\DateTimeInterface $date_rendezvous): self
    {
        $this->date_rendezvous = $date_rendezvous;

        return $this;
    }

    public function getDescriptionRendezvous(): ?string
    {
        return $this->description_rendezvous;
    }

    public function setDescriptionRendezvous(string $description_rendezvous): self
    {
        $this->description_rendezvous = $description_rendezvous;

        return $this;
    }

    public function getTelephonenum(): ?string
    {
        return $this->telephonenum;
    }

    public function setTelephonenum(string $telephonenum): self
    {
        $this->telephonenum = $telephonenum;

        return $this;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(Avis $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getAdressrend(): ?string
    {
        return $this->adressrend;
    }

    public function setAdressrend(string $adressrend): self
    {
        $this->adressrend = $adressrend;

        return $this;
    }

    public function getClient(): ?user
    {
        return $this->client;
    }

    public function setClient(?user $client): self
    {
        $this->client = $client;

        return $this;
    }

}
