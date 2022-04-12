<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\Column(type: 'string', length: 255)]
    private $cheminIcone;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categorieEnfant')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorieEnfant;

    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'categorie')]
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCheminIcone(): ?string
    {
        return $this->cheminIcone;
    }

    public function setCheminIcone(string $cheminIcone): self
    {
        $this->cheminIcone = $cheminIcone;

        return $this;
    }

    public function getCategorieEnfant(): ?self
    {
        return $this->categorieEnfant;
    }

    public function setCategorieEnfant(?self $categorieEnfant): self
    {
        $this->categorieEnfant = $categorieEnfant;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->addCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeCategorie($this);
        }

        return $this;
    }
}
