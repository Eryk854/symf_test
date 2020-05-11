<?php

namespace App\Entity;

use App\Repository\InstytucjaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Sylabus::class, mappedBy="jednostkaRealizujaca")
     */
    private $realizowaneSylabusy;

    /**
     * @ORM\OneToMany(targetEntity=Sylabus::class, mappedBy="jednostkaZlecajaca")
     */
    private $zleconeSylabusy;

    public function __construct()
    {
        $this->realizowaneSylabusy = new ArrayCollection();
        $this->zleconeSylabusy = new ArrayCollection();
    }

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

    /**
     * @return Collection|Sylabus[]
     */
    public function getRealizowaneSylabusy(): Collection
    {
        return $this->realizowaneSylabusy;
    }

    public function addRealizowanySylabus(Sylabus $sylabus): self
    {
        if (!$this->realizowaneSylabusy->contains($sylabus)) {
            $this->realizowaneSylabusy[] = $sylabus;
            $sylabus->setJednostkaRealizujaca($this);
        }

        return $this;
    }

    public function removeRealizowanySylabus(Sylabus $sylabus): self
    {
        if ($this->realizowaneSylabusy->contains($sylabus)) {
            $this->realizowaneSylabusy->removeElement($sylabus);
            // set the owning side to null (unless already changed)
            if ($sylabus->getJednostkaRealizujaca() === $this) {
                $sylabus->setJednostkaRealizujaca(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sylabus[]
     */
    public function getZleconeSylabusy(): Collection
    {
        return $this->zleconeSylabusy;
    }

    public function addZleconeSylabusy(Sylabus $zleconeSylabusy): self
    {
        if (!$this->zleconeSylabusy->contains($zleconeSylabusy)) {
            $this->zleconeSylabusy[] = $zleconeSylabusy;
            $zleconeSylabusy->setJednostkaZlecajaca($this);
        }

        return $this;
    }

    public function removeZleconeSylabusy(Sylabus $zleconeSylabusy): self
    {
        if ($this->zleconeSylabusy->contains($zleconeSylabusy)) {
            $this->zleconeSylabusy->removeElement($zleconeSylabusy);
            // set the owning side to null (unless already changed)
            if ($zleconeSylabusy->getJednostkaZlecajaca() === $this) {
                $zleconeSylabusy->setJednostkaZlecajaca(null);
            }
        }

        return $this;
    }
}
