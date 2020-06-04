<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
class Program
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min = 1,
     *     max = 255,
     *     allowEmptyString = true
     * )
     */
    private $opis;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\Length(
     *     min = 1,
     *     max = 9,
     *     allowEmptyString = true
     * )
     */
    private $rok_akademicki;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min = 1,
     *     max = 255,
     *     allowEmptyString = true
     * )
     */
    private $forma_studiow;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min = 1,
     *     max = 255,
     *     allowEmptyString = true
     * )
     */
    private $poziom_studiow;


    /**
     * @ORM\OneToMany(targetEntity=Sylabus::class, mappedBy="program")
     */
    private $sylabusy;


    /**
     * @ORM\ManyToOne(targetEntity=Kierunek::class, inversedBy="program")
     */
    private $kierunek;



    public function __construct()
    {
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

    public function getRokAkademicki(): ?string
    {
        return $this->rok_akademicki;
    }

    public function setRokAkademicki(string $rok_akademicki): self
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



    public function getKierunek(): ?Kierunek
    {
        return $this->kierunek;
    }

    public function setKierunek(?Kierunek $kierunek): self
    {
        $this->kierunek = $kierunek;

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}
