<?php

namespace App\Entity;

use App\Repository\ChasseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChasseRepository::class)
 */
class Chasse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PokemonType::class, inversedBy="chasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pokemon;

    /**
     * @ORM\ManyToOne(targetEntity=ChasseWorld::class, inversedBy="chasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chasseworld;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChasseWorld(): ?ChasseWorld
    {
        return $this->chasseworld;
    }
    

    public function setChasseWorld(ChasseWorld $chasseworld): self
    {
        $this->chasseworld = $chasseworld;

        return $this;
    }
}
