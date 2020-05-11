<?php

namespace App\Entity;

use App\Repository\SemestrRepository;
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
}