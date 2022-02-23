<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ecrivez quelque chose")
     */
    private $entete;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ecrivez quelque chose")
     */
    private $corp;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ecrivez quelque chose")
     */
    private $redacteur;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     * @Assert\File(
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Only jpeg or png are allowed."
     * )
     *
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="article_id")
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->date = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntete(): ?string
    {
        return $this->entete;
    }

    public function setEntete(string $entete): self
    {
        $this->entete = $entete;

        return $this;
    }

    public function getCorp(): ?string
    {
        return $this->corp;
    }

    public function setCorp(string $corp): self
    {
        $this->corp = $corp;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRedacteur(): ?string
    {
        return $this->redacteur;
    }

    public function setRedacteur(string $redacteur): self
    {
        $this->redacteur = $redacteur;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage( $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setArticleId($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticleId() === $this) {
                $commentaire->setArticleId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getEntete();
    }


}
