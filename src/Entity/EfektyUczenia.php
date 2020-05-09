<?php

namespace App\Entity;

class EfektyUczenia
{
    private $wiedza;

    private $umiejetnosci;

    private $kompetencje;

    public function getWiedza(): ?string
    {
        return $this->wiedza;
    }

    public function setWiedza(?string $wiedza): self
    {
        $this->wiedza = $wiedza;

        return $this;
    }

    public function getUmiejetnosci(): ?string
    {
        return $this->umiejetnosci;
    }

    public function setUmiejetnosci(?string $umiejetnosci): self
    {
        $this->umiejetnosci = $umiejetnosci;

        return $this;
    }

    public function getKompetencje(): ?string
    {
        return $this->kompetencje;
    }

    public function setKompetencje(?string $kompetencje): self
    {
        $this->kompetencje = $kompetencje;

        return $this;
    }
}
