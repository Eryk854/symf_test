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
     * @ORM\OneToMany(targetEntity="App\Entity\Sylabus", mappedBy="semestr")
     */
    private $sylabus;

    public function __construct()
    {
        $this->sylabus = new ArrayCollection();
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
    public function getSylabus(): Collection
    {
        return $this->sylabus;
    }

    public function addSylabus(Sylabus $sylabus): self
    {
        if (!$this->sylabus->contains($sylabus)) {
            $this->sylabus[] = $sylabus;
            $sylabus->setSemestr($this);
        }

        return $this;
    }

    public function removeSylabus(Sylabus $sylabus): self
    {
        if ($this->sylabus->contains($sylabus)) {
            $this->sylabus->removeElement($sylabus);
            // set the owning side to null (unless already changed)
            if ($sylabus->getSemestr() === $this) {
                $sylabus->setSemestr(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}
