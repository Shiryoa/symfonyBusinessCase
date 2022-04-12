<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 50)]
    private $prenom;


    #[ORM\Column(type: 'date')]
    private $dateNaissance;

    #[ORM\Column(type: 'date')]
    private $dateInscription;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Adresse::class)]
    private $adresses;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: avis::class)]
    private $avis;

    #[ORM\ManyToMany(targetEntity: commande::class, inversedBy: 'clients')]
    private $commande;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: animal::class)]
    private $animal;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->commande = new ArrayCollection();
        $this->animal = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setClient($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getClient() === $this) {
                $adress->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setClient($this);
        }

        return $this;
    }

    public function removeAvi(avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getClient() === $this) {
                $avi->setClient(null);
            }
        }

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
     * @return Collection<int, animal>
     */
    public function getAnimal(): Collection
    {
        return $this->animal;
    }

    public function addAnimal(animal $animal): self
    {
        if (!$this->animal->contains($animal)) {
            $this->animal[] = $animal;
            $animal->setClient($this);
        }

        return $this;
    }

    public function removeAnimal(animal $animal): self
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getClient() === $this) {
                $animal->setClient(null);
            }
        }

        return $this;
    }
}
