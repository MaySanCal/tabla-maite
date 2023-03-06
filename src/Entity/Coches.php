<?php

namespace App\Entity;

use App\Repository\CochesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CochesRepository::class)]
class Coches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $Apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $Direccion = null;

    #[ORM\Column]
    private ?int $Telefono = null;

    #[ORM\ManyToOne(inversedBy: 'coches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marcas $Marca = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): self
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->Direccion;
    }

    public function setDireccion(string $Direccion): self
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->Telefono;
    }

    public function setTelefono(int $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getMarca(): ?Marcas
    {
        return $this->Marca;
    }

    public function setMarca(?Marcas $Marca): self
    {
        $this->Marca = $Marca;

        return $this;
    }
}
