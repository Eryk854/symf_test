<?php

namespace App\Entity;

use App\Repository\KierunekRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KierunekRepository::class)
 */
class Kierunek
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="kierunek")
     */
    private $program;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $wydzial;

    public function __construct()
    {
        $this->program = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }


    public function addProgram(Program $program): self
    {
        if (!$this->program->contains($program)) {
            $this->program[] = $program;
            $program->setKierunek($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->program->contains($program)) {
            $this->program->removeElement($program);
            // set the owning side to null (unless already changed)
            if ($program->getKierunek() === $this) {
                $program->setKierunek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgram(): Collection
    {
        return $this->program;
    }

    public function __toString()
    {
        return $this->nazwa;
    }

    public function getWydzial(): ?string
    {
        return $this->wydzial;
    }

    public function setWydzial(?string $wydzial): self
    {
        $this->wydzial = $wydzial;

        return $this;
    }
}