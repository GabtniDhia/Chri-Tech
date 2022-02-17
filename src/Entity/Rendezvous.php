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
    private $Service;

    /**
     * @ORM\Column(type="date")

     * @Assert\Type("\DateTime")
     * @Assert\GreaterThan("today")
     */
    private $date_Rendezvous;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description_Rendezvous;

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
     * @ORM\Column(type="string", length=255)
     */
    private $adresserend;



    public function getId(): ?int
    {
        return $this->id;
    }





    public function getService(): ?string
    {
        return $this->Service;
    }

    public function setService(string $Service): self
    {
        $this->Service = $Service;

        return $this;
    }

    public function getDateRendezvous(): ?\DateTimeInterface
    {
        return $this->date_Rendezvous;
    }

    public function setDateRendezvous(\DateTimeInterface $date_Rendezvous): self
    {
        $this->date_Rendezvous = $date_Rendezvous;

        return $this;
    }

    public function getDescriptionRendezvous(): ?string
    {
        return $this->Description_Rendezvous;
    }

    public function setDescriptionRendezvous(string $Description_Rendezvous): self
    {
        $this->Description_Rendezvous = $Description_Rendezvous;

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

    public function getAdresserend(): ?string
    {
        return $this->adresserend;
    }

    public function setAdresserend(string $adresserend): self
    {
        $this->adresserend = $adresserend;

        return $this;
    }


}
