<?php

namespace App\Entity;

use App\Repository\GodzinyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GodzinyRepository::class)
 */
class Godziny
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $godziny_wykladowe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $godziny_cwiczeniowe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $czas_pracy_wlasnej;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ECTS;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGodzinyWykladowe(): ?int
    {
        return $this->godziny_wykladowe;
    }

    public function setGodzinyWykladowe(?int $godziny_wykladowe): self
    {
        $this->godziny_wykladowe = $godziny_wykladowe;

        return $this;
    }

    public function getGodzinyCwiczeniowe(): ?int
    {
        return $this->godziny_cwiczeniowe;
    }

    public function setGodzinyCwiczeniowe(?int $godziny_cwiczeniowe): self
    {
        $this->godziny_cwiczeniowe = $godziny_cwiczeniowe;

        return $this;
    }

    public function getCzasPracyWlasnej(): ?int
    {
        return $this->czas_pracy_wlasnej;
    }

    public function setCzasPracyWlasnej(?int $czas_pracy_wlasnej): self
    {
        $this->czas_pracy_wlasnej = $czas_pracy_wlasnej;

        return $this;
    }

    public function getECTS(): ?int
    {
        return $this->ECTS;
    }

    public function setECTS(?int $ECTS): self
    {
        $this->ECTS = $ECTS;

        return $this;
    }
}
