<?php

namespace App\Entity;

class MiejsceRealizacji
{

    private $wyklad;

    private $cwiczenia;



    public function getWyklad(): ?string
    {
        return $this->wyklad;
    }

    public function setWyklad(?string $wyklad): self
    {

        $this->wyklad = $wyklad;

        return $this;
    }

    public function getCwiczenia(): ?string
    {
        return $this->cwiczenia;
    }

    public function setCwiczenia(?string $cwiczenia): self
    {
        $this->cwiczenia = $cwiczenia;

        return $this;
    }


}
