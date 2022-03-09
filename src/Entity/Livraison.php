<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="commandel" )
     */
    private $commandes;

    /**
     * @ORM\Column(type="time")
     */
    private $heurelivraison;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }



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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setCommandel($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getCommandel() === $this) {
                $commande->setCommandel(null);
            }
        }

        return $this;
    }

    public function getHeurelivraison(): ?\DateTimeInterface
    {
        return $this->heurelivraison;
    }

    public function setHeurelivraison(\DateTimeInterface $heurelivraison): self
    {
        $this->heurelivraison = $heurelivraison;

        return $this;
    }




}
