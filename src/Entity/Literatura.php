<?php

namespace App\Entity;

use App\Repository\LiteraturaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiteraturaRepository::class)
 */
class Literatura
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
    private $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rodzaj;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tytul;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wydawnictwo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getRodzaj(): ?string
    {
        return $this->rodzaj;
    }

    public function setRodzaj(?string $rodzaj): self
    {
        $this->rodzaj = $rodzaj;

        return $this;
    }

    public function getTytul(): ?string
    {
        return $this->tytul;
    }

    public function setTytul(?string $tytul): self
    {
        $this->tytul = $tytul;

        return $this;
    }

    public function getWydawnictwo(): ?string
    {
        return $this->wydawnictwo;
    }

    public function setWydawnictwo(?string $wydawnictwo): self
    {
        $this->wydawnictwo = $wydawnictwo;

        return $this;
    }
}
