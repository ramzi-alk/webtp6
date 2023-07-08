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
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pokemons")
     * @ORM\JoinColumn(name="id_dresseur", referencedColumnName="id", nullable=false)
     */
    private $dresseur;

    /**
     * @ORM\ManyToOne(targetEntity=PokemonType::class, inversedBy="commerces")
     * @ORM\JoinColumn(name="id_pokemon", referencedColumnName="id", nullable=false)
     */
    private $pokemon;

    /**
     * @ORM\Column(type="integer")
     */
    private $salePrice;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pokemons")
     * @ORM\JoinColumn(name="id_acheteur", referencedColumnName="id", nullable=true)
     */
    private $acheteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDresseur(): ?User
    {
        return $this->dresseur;
    }

    public function setDresseur(?User $dresseur): self
    {
        $this->dresseur = $dresseur;

        return $this;
    }

    public function getPokemon(): ?PokemonType
    {
        return $this->pokemon;
    }

    public function setPokemon(?PokemonType $pokemon): self
    {
        $this->pokemon = $pokemon;

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

    public function getAcheteur(): ?User
    {
        return $this->acheteur;
    }

    public function setAcheteur(?User $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }
}
