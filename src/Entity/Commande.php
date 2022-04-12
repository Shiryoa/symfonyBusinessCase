<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $dateCommande;

    #[ORM\Column(type: 'boolean')]
    private $parCB;

    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'commande')]
    private $clients;

    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'commande')]
    private $produits;

    #[ORM\ManyToOne(targetEntity: etatCommande::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $etatCommande;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getParCB(): ?bool
    {
        return $this->parCB;
    }

    public function setParCB(bool $parCB): self
    {
        $this->parCB = $parCB;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->addCommande($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            $client->removeCommande($this);
        }

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
            $produit->addCommande($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeCommande($this);
        }

        return $this;
    }

    public function getEtatCommande(): ?etatCommande
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?etatCommande $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }
}
