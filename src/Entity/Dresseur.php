<?php

namespace App\Entity;

use App\Repository\DresseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DresseurRepository::class)
 */
class Dresseur
{


    /*** @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idDresseur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $pieces;

    /**
     * @ORM\OneToMany(targetEntity=Commerce::class, mappedBy="idDresseur")
     */
    private $idPokemon;

    public function __construct()
    {
        $this->idPokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDresseur(): ?int
    {
        return $this->idDresseur;
    }

    public function setIdDresseur(int $idDresseur): self
    {
        $this->idDresseur = $idDresseur;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPieces(): ?int
    {
        return $this->pieces;
    }

    public function setPieces(int $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    /**
     * @return Collection<int, Commerce>
     */
    public function getIdPokemon(): Collection
    {
        return $this->idPokemon;
    }

    public function addIdPokemon(Commerce $idPokemon): self
    {
        if (!$this->idPokemon->contains($idPokemon)) {
            $this->idPokemon[] = $idPokemon;
            $idPokemon->setIdDresseur($this);
        }

        return $this;
    }

    public function removeIdPokemon(Commerce $idPokemon): self
    {
        if ($this->idPokemon->removeElement($idPokemon)) {
            // set the owning side to null (unless already changed)
            if ($idPokemon->getIdDresseur() === $this) {
                $idPokemon->setIdDresseur(null);
            }
        }

        return $this;
    }
}
