<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 50)]
    private $marque;

    #[ORM\Column(type: 'float')]
    private $prixHT;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\Column(type: 'boolean')]
    private $estDisponible;

    #[ORM\Column(type: 'datetime')]
    private $dateAjout;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Photo::class)]
    private $photos;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Avis::class)]
    private $avisProduit;

    #[ORM\ManyToOne(targetEntity: especeAnimal::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private $especeAnimal;

    #[ORM\ManyToMany(targetEntity: commande::class, inversedBy: 'produits')]
    private $commande;

    #[ORM\ManyToMany(targetEntity: categorie::class, inversedBy: 'produits')]
    private $categorie;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->avisProduit = new ArrayCollection();
        $this->commande = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrixHT(): ?float
    {
        return $this->prixHT;
    }

    public function setPrixHT(float $prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getEstDisponible(): ?bool
    {
        return $this->estDisponible;
    }

    public function setEstDisponible(bool $estDisponible): self
    {
        $this->estDisponible = $estDisponible;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setProduit($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProduit() === $this) {
                $photo->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvisProduit(): Collection
    {
        return $this->avisProduit;
    }

    public function addAvisProduit(Avis $avisProduit): self
    {
        if (!$this->avisProduit->contains($avisProduit)) {
            $this->avisProduit[] = $avisProduit;
            $avisProduit->setProduit($this);
        }

        return $this;
    }

    public function removeAvisProduit(Avis $avisProduit): self
    {
        if ($this->avisProduit->removeElement($avisProduit)) {
            // set the owning side to null (unless already changed)
            if ($avisProduit->getProduit() === $this) {
                $avisProduit->setProduit(null);
            }
        }

        return $this;
    }

    public function getEspeceAnimal(): ?especeAnimal
    {
        return $this->especeAnimal;
    }

    public function setEspeceAnimal(?especeAnimal $especeAnimal): self
    {
        $this->especeAnimal = $especeAnimal;

        return $this;
    }

    /**
     * @return Collection<int, commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
        }

        return $this;
    }

    public function removeCommande(commande $commande): self
    {
        $this->commande->removeElement($commande);

        return $this;
    }

    /**
     * @return Collection<int, categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }
}
