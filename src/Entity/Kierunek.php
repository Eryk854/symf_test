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
    private $informacje;

    /**
     * @ORM\OneToMany(targetEntity=Program::class, mappedBy="kierunek")
     */
    private $program;

    public function __construct()
    {
        $this->program = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInformacje(): ?string
    {
        return $this->informacje;
    }

    public function setInformacje(string $informacje): self
    {
        $this->informacje = $informacje;

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
}