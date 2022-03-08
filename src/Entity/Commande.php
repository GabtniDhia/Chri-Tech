<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez votre nom")
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Entrez votre numéro de téléphone")
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Numéro saisi invalide",
     *      maxMessage = "Numéro saisi invalide"
     * )
     */
    private $numtel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Entrez votre adresse e-mail")
     * @Assert\Email(message = "L'adresse '{{ value }}' est invalide.")
     *
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="commandes",cascade={"persist"})
     */
    private $commandel;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNumtel(): ?int
    {
        return $this->numtel;
    }

    public function setNumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCommandel(): ?Livraison
    {
        return $this->commandel;
    }

    public function setCommandel(?Livraison $commandel): self
    {
        $this->commandel = $commandel;

        return $this;
    }

    public function __toString()
    {
return $this->getNom();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
