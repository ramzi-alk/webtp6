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
     * @ORM\Column(type="integer")
     */
    private $id_world;

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

    public function getIdWorld(): ?int
    {
        return $this->id_world;
    }

    public function setIdWorld(int $id_world): self
    {
        $this->id_world = $id_world;

        return $this;
    }
}
