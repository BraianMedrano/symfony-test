<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido = null;

    #[ORM\Column(nullable: true)]
    private ?int $edad = null;

    #[ORM\OneToMany(targetEntity: Materias::class, mappedBy: 'usuario')]
    private Collection $materias;

    public function __construct()
    {
        $this->materias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): static
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * @return Collection<int, Materias>
     */
    public function getMaterias(): Collection
    {
        return $this->materias;
    }

    public function addMateria(Materias $materia): static
    {
        if (!$this->materias->contains($materia)) {
            $this->materias->add($materia);
            $materia->setUsuario($this);
        }

        return $this;
    }

    public function removeMateria(Materias $materia): static
    {
        if ($this->materias->removeElement($materia)) {
            // set the owning side to null (unless already changed)
            if ($materia->getUsuario() === $this) {
                $materia->setUsuario(null);
            }
        }

        return $this;
    }
}
