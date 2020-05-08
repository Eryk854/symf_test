<?php

namespace App\Entity;

use App\Repository\UzytkownikRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UzytkownikRepository::class)
 */
class Uzytkownik
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $typ;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $daneKontaktowe;

    /**
     * @ORM\OneToMany(targetEntity=Sylabus::class, mappedBy="koordynatorZajec")
     */
    private $koordynowaneSylabusy;

    /**
     * @ORM\ManyToMany(targetEntity=Sylabus::class, mappedBy="prowadzacyZajecia")
     */
    private $prowadzoneSylabusy;

    public function __construct()
    {
        $this->koordynowaneSylabusy = new ArrayCollection();
        $this->prowadzoneSylabusy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTyp(): ?string
    {
        return $this->typ;
    }

    public function setTyp(string $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function getDaneKontaktowe(): ?string
    {
        return $this->daneKontaktowe;
    }

    public function setDaneKontaktowe(?string $daneKontaktowe): self
    {
        $this->daneKontaktowe = $daneKontaktowe;

        return $this;
    }

    /**
     * @return Collection|Sylabus[]
     */
    public function getKoordynowaneSylabusy(): Collection
    {
        return $this->koordynowaneSylabusy;
    }

    public function addKoordynowaneSylabusy(Sylabus $sylabus): self
    {
        if (!$this->koordynowaneSylabusy->contains($sylabus)) {
            $this->koordynowaneSylabusy[] = $sylabus;
            $sylabus->setKoordynatorZajec($this);
        }

        return $this;
    }

    public function removeKoordynowaneSylabusy(Sylabus $sylabus): self
    {
        if ($this->koordynowaneSylabusy->contains($sylabus)) {
            $this->koordynowaneSylabusy->removeElement($sylabus);
            // set the owning side to null (unless already changed)
            if ($sylabus->getKoordynatorZajec() === $this) {
                $sylabus->setKoordynatorZajec(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sylabus[]
     */
    public function getProwadzoneSylabusy(): Collection
    {
        return $this->prowadzoneSylabusy;
    }

    public function addProwadzoneSylabusy(Sylabus $prowadzoneSylabusy): self
    {
        if (!$this->prowadzoneSylabusy->contains($prowadzoneSylabusy)) {
            $this->prowadzoneSylabusy[] = $prowadzoneSylabusy;
            $prowadzoneSylabusy->addProwadzacyZajecium($this);
        }

        return $this;
    }

    public function removeProwadzoneSylabusy(Sylabus $prowadzoneSylabusy): self
    {
        if ($this->prowadzoneSylabusy->contains($prowadzoneSylabusy)) {
            $this->prowadzoneSylabusy->removeElement($prowadzoneSylabusy);
            $prowadzoneSylabusy->removeProwadzacyZajecium($this);
        }

        return $this;
    }
}
