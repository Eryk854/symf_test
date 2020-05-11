<?php

namespace App\Entity;

use App\Repository\SemestrRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemestrRepository::class)
 */
class Semestr
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numer_semestru;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $rodzaj_semestru;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Program", mappedBy="semestr")
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

    public function getNumerSemestru(): ?int
    {
        return $this->numer_semestru;
    }

    public function setNumerSemestru(int $numer_semestru): self
    {
        $this->numer_semestru = $numer_semestru;

        return $this;
    }

    public function getRodzajSemestru(): ?string
    {
        return $this->rodzaj_semestru;
    }

    public function setRodzajSemestru(?string $rodzaj_semestru): self
    {
        $this->rodzaj_semestru = $rodzaj_semestru;

        return $this;
    }

    /**
     * @return Collection|Program[]
     */
    public function getProgram(): Collection
    {
        return $this->program;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->program->contains($program)) {
            $this->program[] = $program;
            $program->setSemestr($this);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        if ($this->program->contains($program)) {
            $this->program->removeElement($program);
            // set the owning side to null (unless already changed)
            if ($program->getSemestr() === $this) {
                $program->setSemestr(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}
