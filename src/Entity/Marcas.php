<?php

namespace App\Entity;

use App\Repository\MarcasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarcasRepository::class)]
class Marcas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $types = null;

    #[ORM\OneToMany(mappedBy: 'Marca', targetEntity: Coches::class)]
    private Collection $coches;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypes(): ?string
    {
        return $this->types;
    }

    public function setTypes(string $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection<int, Coches>
     */
    public function getCoches(): Collection
    {
        return $this->coches;
    }

    public function addCoch(Coches $coch): self
    {
        if (!$this->coches->contains($coch)) {
            $this->coches->add($coch);
            $coch->setMarca($this);
        }

        return $this;
    }

    public function removeCoch(Coches $coch): self
    {
        if ($this->coches->removeElement($coch)) {
            // set the owning side to null (unless already changed)
            if ($coch->getMarca() === $this) {
                $coch->setMarca(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this -> types;
    
    }
}

