<?php

namespace App\Entity;

use App\Repository\CommerceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommerceRepository::class)
 */
class Commerce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Dresseur::class, inversedBy="idPokemon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idDresseur;

    /**
     * @ORM\ManyToOne(targetEntity=PokemonType::class, inversedBy="commerces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPokemon;

    /**
     * @ORM\Column(type="integer")
     */
    private $salePrice;

    /**
     * @ORM\ManyToOne(targetEntity=Dresseur::class)
     */
    private $idAcheteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDresseur(): ?Dresseur
    {
        return $this->idDresseur;
    }

    public function setIdDresseur(?Dresseur $idDresseur): self
    {
        $this->idDresseur = $idDresseur;

        return $this;
    }

    public function getIdPokemon(): ?PokemonType
    {
        return $this->idPokemon;
    }

    public function setIdPokemon(?PokemonType $idPokemon): self
    {
        $this->idPokemon = $idPokemon;

        return $this;
    }

    public function getSalePrice(): ?int
    {
        return $this->salePrice;
    }

    public function setSalePrice(int $salePrice): self
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    public function getIdAcheteur(): ?Dresseur
    {
        return $this->idAcheteur;
    }

    public function setIdAcheteur(?Dresseur $idAcheteur): self
    {
        $this->idAcheteur = $idAcheteur;

        return $this;
    }
}
