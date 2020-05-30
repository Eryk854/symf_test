<?php

namespace App\Entity;

use App\Repository\GodzinyRepository;

class Godziny
{
    private $id;

    private $godziny_wykladowe;

    private $godziny_cwiczeniowe;

    private $godziny_laboratoryjne;

    private $godziny_projektowe;

    private $godziny_terenowe;

    private $godziny_praktyki;

    private $czas_pracy_wlasnej;

    private $ECTS;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGodzinyProjektowe(): ?int
    {
        return $this->godziny_projektowe;
    }

    public function setGodzinyProjektowe(?int $godziny_projektowe): void
    {
        $this->godziny_projektowe = $godziny_projektowe;
    }

    public function getGodzinyTerenowe(): ?int
    {
        return $this->godziny_terenowe;
    }

    public function setGodzinyTerenowe(?int $godziny_terenowe): void
    {
        $this->godziny_terenowe = $godziny_terenowe;
    }

    public function getGodzinyPraktyki(): ?int
    {
        return $this->godziny_praktyki;
    }

    public function setGodzinyPraktyki(?int $godziny_praktyki): void
    {
        $this->godziny_praktyki = $godziny_praktyki;
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

    public function getGodzinyLaboratoryjne(): ?int
    {
        return $this->godziny_laboratoryjne;
    }

    public function setGodzinyLaboratoryjne(?int $godziny_laboratoryjne): void
    {
        $this->godziny_laboratoryjne = $godziny_laboratoryjne;
    }


    public function __toString()
    {
        return 'ECTS: ' . $this->getECTS() . ' Godziny cwiczeniowe ' . $this->getGodzinyCwiczeniowe() . ' Godziny wykladowe: ' . $this->getGodzinyWykladowe();
    }


}
