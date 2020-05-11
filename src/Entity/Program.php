<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
class Program
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
    private $opis;

    /**
     * @ORM\Column(type="integer")
     */
    private $rok_akademicki;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $forma_studiow;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poziom_studiow;

    /**
     * @ORM\OneToMany(targetEntity=Kierunek::class, mappedBy="program")
     */
    private $kierunek;


    /**
     * @ORM\OneToMany(targetEntity=Sylabus::class, mappedBy="program")
     */
    private $sylabusy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Semestr", inversedBy="program")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semestr;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kierunek", inversedBy="program")
     * @ORM\JoinColumn(nullable=false)
     */
    private $program;


    public function __construct()
    {
        $this->kierunek = new ArrayCollection();
        $this->sylabusy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }

    public function getRokAkademicki(): ?int
    {
        return $this->rok_akademicki;
    }

    public function setRokAkademicki(int $rok_akademicki): self
    {
        $this->rok_akademicki = $rok_akademicki;

        return $this;
    }

    public function getFormaStudiow(): ?string
    {
        return $this->forma_studiow;
    }

    public function setFormaStudiow(string $forma_studiow): self
    {
        $this->forma_studiow = $forma_studiow;

        return $this;
    }

    public function getPoziomStudiow(): ?string
    {
        return $this->poziom_studiow;
    }

    public function setPoziomStudiow(string $poziom_studiow): self
    {
        $this->poziom_studiow = $poziom_studiow;

        return $this;
    }

    /**
     * @return Collection|Kierunek[]
     */
    public function getKierunek(): Collection
    {
        return $this->kierunek;
    }

    public function addKierunek(Kierunek $kierunek): self
    {
        if (!$this->kierunek->contains($kierunek)) {
            $this->kierunek[] = $kierunek;
            $kierunek->setProgram($this);
        }

        return $this;
    }

    public function removeKierunek(Kierunek $kierunek): self
    {
        if ($this->kierunek->contains($kierunek)) {
            $this->kierunek->removeElement($kierunek);
            // set the owning side to null (unless already changed)
            if ($kierunek->getProgram() === $this) {
                $kierunek->setProgram(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sylabus[]
     */
    public function getSylabusy(): Collection
    {
        return $this->sylabusy;
    }

    public function addSylabusy(Sylabus $sylabusy): self
    {
        if (!$this->sylabusy->contains($sylabusy)) {
            $this->sylabusy[] = $sylabusy;
            $sylabusy->setProgram($this);
        }

        return $this;
    }

    public function removeSylabusy(Sylabus $sylabusy): self
    {
        if ($this->sylabusy->contains($sylabusy)) {
            $this->sylabusy->removeElement($sylabusy);
            // set the owning side to null (unless already changed)
            if ($sylabusy->getProgram() === $this) {
                $sylabusy->setProgram(null);
            }
        }

        return $this;
    }

    public function getSemestr(): ?Semestr
    {
        return $this->semestr;
    }

    public function setSemestr(?Semestr $semestr): self
    {
        $this->semestr = $semestr;

        return $this;
    }

    public function getProgram(): ?Kierunek
    {
        return $this->program;
    }

    public function setProgram(?Kierunek $program): self
    {
        $this->program = $program;

        return $this;
    }
}
