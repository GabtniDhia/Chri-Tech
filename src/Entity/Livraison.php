<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez votre adresse exacte")
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Entrez votre code postal")
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      minMessage = "Numéro saisi invalide",
     *      maxMessage = "Numéro saisi invalide"
     * )
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank(message="Entrez votre ville")
     */
    private $ville;

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("\DateTime")
     * @Assert\GreaterThan("today")
     */
    private $datelivraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDatelivraison(): ?\DateTimeInterface
    {
        return $this->datelivraison;
    }

    public function setDatelivraison(\DateTimeInterface $datelivraison): self
    {
        $this->datelivraison = $datelivraison;

        return $this;
    }
}
