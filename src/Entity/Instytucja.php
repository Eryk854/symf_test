<?php

namespace App\Entity;

use App\Repository\InstytucjaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstytucjaRepository::class)
 */
class Instytucja
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
    private $pelna_nazwa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nazwa_skrocona;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $opis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPelnaNazwa(): ?string
    {
        return $this->pelna_nazwa;
    }

    public function setPelnaNazwa(string $pelna_nazwa): self
    {
        $this->pelna_nazwa = $pelna_nazwa;

        return $this;
    }

    public function getNazwaSkrocona(): ?string
    {
        return $this->nazwa_skrocona;
    }

    public function setNazwaSkrocona(?string $nazwa_skrocona): self
    {
        $this->nazwa_skrocona = $nazwa_skrocona;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(?string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(?string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }
}
