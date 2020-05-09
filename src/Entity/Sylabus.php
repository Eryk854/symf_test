<?php

namespace App\Entity;

use App\Repository\SylabusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass=SylabusRepository::class)
 */
class Sylabus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Zajecia::class, cascade={"persist", "remove"})
     */
    private $zajecia;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numerKatalogowy;

    /**
     * @ORM\ManyToOne(targetEntity=Uzytkownik::class, inversedBy="$koordynowaneSylabusy")
     * @JoinColumn(name="koordynator_id", referencedColumnName="id")
     */
    private $koordynatorZajec;

    /**
     * @ORM\ManyToMany(targetEntity=Uzytkownik::class, inversedBy="prowadzoneSylabusy")
     * @JoinTable(name="prowadzacy_sylabusy",
     *      joinColumns={@JoinColumn(name="sylabus_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="prowadzacy_id", referencedColumnName="id")}
     *      )
     */
    private $prowadzacyZajecia;

    public function __construct()
    {
        $this->prowadzacyZajecia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZajecia(): ?Zajecia
    {
        return $this->zajecia;
    }

    public function setZajecia(?Zajecia $zajecia): self
    {
        $this->zajecia = $zajecia;

        return $this;
    }

    public function getNumerKatalogowy(): ?string
    {
        return $this->numerKatalogowy;
    }

    public function setNumerKatalogowy(?string $numerKatalogowy): self
    {
        $this->numerKatalogowy = $numerKatalogowy;

        return $this;
    }

    public function getKoordynatorZajec(): ?Uzytkownik
    {
        return $this->koordynatorZajec;
    }

    public function setKoordynatorZajec(?Uzytkownik $koordynatorZajec): self
    {
        $this->koordynatorZajec = $koordynatorZajec;

        return $this;
    }

    /**
     * @return Collection|Uzytkownik[]
     */
    public function getProwadzacyZajecia(): Collection
    {
        return $this->prowadzacyZajecia;
    }

    public function addProwadzacyZajecium(Uzytkownik $prowadzacyZajecium): self
    {
        if (!$this->prowadzacyZajecia->contains($prowadzacyZajecium)) {
            $this->prowadzacyZajecia[] = $prowadzacyZajecium;
        }

        return $this;
    }

    public function removeProwadzacyZajecium(Uzytkownik $prowadzacyZajecium): self
    {
        if ($this->prowadzacyZajecia->contains($prowadzacyZajecium)) {
            $this->prowadzacyZajecia->removeElement($prowadzacyZajecium);
        }

        return $this;
    }
}
