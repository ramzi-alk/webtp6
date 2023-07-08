<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntityRepository")
 * @ORM\Table(name="ref_pokemon_type")
 */
class PokemonType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="ElementaryType")
     * @ORM\JoinColumn(name="type_1", referencedColumnName="id")
     */
    private $type1;

    /**
     * @ORM\ManyToOne(targetEntity="ElementaryType")
     * @ORM\JoinColumn(name="type_2", referencedColumnName="id",nullable=true)
     */
    private $type2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $evolution;


    /**
     * @ORM\Column(type="boolean")
     */
    private $starter;

    /**
     * @ORM\Column(type="string", length=1,options={"fixed" = true})
     */
    private $typeCourbeNiveau;


    /**
     * @ORM\Column(type="integer")
     */
    private $xp =0 ;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastTraining ;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $idDresseur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etatVente = false;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveau = 0;

    /**
     * @ORM\OneToMany(targetEntity=Commerce::class, mappedBy="pokemon")
     */
    private $commerces;

    /**
     * @ORM\OneToMany(targetEntity=Chasse::class, mappedBy="pokemon")
     */
    private $chasses;

    public function __construct()
    {
        $this->chasses = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
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

    public function getEvolution(): ?bool
    {
        return $this->evolution;
    }

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(int $xp): self
    {
        $this->xp = $xp;

        return $this;
    }

    public function getLastTraining(): ?\DateTimeInterface
    {
        return $this->lastTraining;
    }

    public function setLastTraining(?\DateTimeInterface $lastTraining): self
    {
        $this->lastTraining = $lastTraining;

        return $this;
    }

    public function getIdDresseur(): ?int
    {
        return $this->idDresseur;
    }

    public function setIdDresseur(?int $idDresseur): self
    {
        $this->idDresseur = $idDresseur;

        return $this;
    }

    public function getEtatVente(): ?bool
    {
        return $this->etatVente;
    }

    public function setEtatVente(bool $etatVente): self
    {
        $this->etatVente = $etatVente;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
    
    public function setEvolution(bool $evolution): self
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getStarter(): ?bool
    {
        return $this->starter;
    }

    public function setStarter(bool $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    public function getTypeCourbeNiveau(): ?string
    {
        return $this->typeCourbeNiveau;
    }

    public function setTypeCourbeNiveau(string $typeCourbeNiveau): self
    {
        $this->typeCourbeNiveau = $typeCourbeNiveau;

        return $this;
    }

    public function getType1(): ?ElementaryType
    {
        return $this->type1;
    }

    public function setType1(?ElementaryType $type1): self
    {
        $this->type1 = $type1;

        return $this;
    }

    public function getType2(): ?ElementaryType
    {
        return $this->type2;
    }

    public function setType2(?ElementaryType $type2): self
    {
        $this->type2 = $type2;

        return $this;
    }

     /**
     * @return Collection<int, Commerce>
     */
    public function getCommerces(): Collection
    {
        return $this->commerces;
    }

    /**
     * @return Collection<int, Chasse>
     */
    public function getChasses(): Collection
    {
        return $this->chasses;
    }

    public function addChass(Chasse $chass): self
    {
        if (!$this->chasses->contains($chass)) {
            $this->chasses[] = $chass;
            $chass->setPokemon($this);
        }

        return $this;
    }

    public function removeChass(Chasse $chass): self
    {
        if ($this->chasses->removeElement($chass)) {
            // set the owning side to null (unless already changed)
            if ($chass->getPokemon() === $this) {
                $chass->setPokemon(null);
            }
        }

        return $this;
    }

}