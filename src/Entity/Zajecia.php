<?php

namespace App\Entity;

use App\Repository\ZajeciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Entity(repositoryClass=ZajeciaRepository::class)
 */
class Zajecia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nazwaPolska;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nazwaAngielska;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $jezykWykladowy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $zalozenia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cele;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $opis;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $zakresTematow ;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $metodyDydaktyczne = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $wymaganiaFormalne;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $zalozeniaWstepne;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $efektyUczenia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $weryfikacjaEfektowUczenia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dokumentacjaEfektowUczenia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $kryteriaOceniania;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $statusPodstawowe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $statusObowiazkowe;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $uwagi;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $miejsceRealizacji;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $godziny;

    /**
     * @ORM\ManyToMany(targetEntity=Literatura::class, inversedBy="zajecia")
     * @JoinTable(name="zajecia_literatura",
     *      joinColumns={@JoinColumn(name="zajecia_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="literatura_id", referencedColumnName="id")}
     *      )
     */
    private $literatura;

    public function __construct()
    {
        $this->literatura = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwaPolska(): ?string
    {
        return $this->nazwaPolska;
    }

    public function setNazwaPolska(string $nazwaPolska): self
    {
        $this->nazwaPolska = $nazwaPolska;

        return $this;
    }

    public function getNazwaAngielska(): ?string
    {
        return $this->nazwaAngielska;
    }

    public function setNazwaAngielska(string $nazwaAngielska): self
    {
        $this->nazwaAngielska = $nazwaAngielska;

        return $this;
    }

    public function getJezykWykladowy(): ?string
    {
        return $this->jezykWykladowy;
    }

    public function setJezykWykladowy(string $jezykWykladowy): self
    {
        $this->jezykWykladowy = $jezykWykladowy;

        return $this;
    }

    public function getZalozenia(): ?string
    {
        return $this->zalozenia;
    }

    public function setZalozenia(?string $zalozenia): self
    {
        $this->zalozenia = $zalozenia;

        return $this;
    }

    public function getCele(): ?string
    {
        return $this->cele;
    }

    public function setCele(?string $cele): self
    {
        $this->cele = $cele;

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

    public function getZakresTematow(): ?string
    {
        return $this->zakresTematow;
    }

    public function setZakresTematow(?string $zakresTematow): self
    {
        $this->zakresTematow = $zakresTematow;

        return $this;
    }

    public function getMetodyDydaktyczne(): ?array
    {
        return $this->metodyDydaktyczne;
    }

    public function setMetodyDydaktyczne(?array $metodyDydaktyczne): self
    {
        $this->metodyDydaktyczne = $metodyDydaktyczne;

        return $this;
    }

    public function getWymaganiaFormalne(): ?string
    {

        return $this->wymaganiaFormalne;
    }

    public function setWymaganiaFormalne(?string $wymaganiaFormalne): self
    {
        $this->wymaganiaFormalne = $wymaganiaFormalne;

        return $this;
    }

    public function getZalozeniaWstepne(): ?string
    {
        return $this->zalozeniaWstepne;
    }

    public function setZalozeniaWstepne(?string $zalozeniaWstepne): self
    {
        $this->zalozeniaWstepne = $zalozeniaWstepne;

        return $this;
    }

    public function getEfektyUczenia(): ?EfektyUczenia
    {
        return $this->efektyUczenia;
    }

    public function setEfektyUczenia(?EfektyUczenia $efektyUczenia): self
    {
        $this->efektyUczenia = $efektyUczenia;

        return $this;
    }

    public function getWeryfikacjaEfektowUczenia(): ?array
    {
        # w bazie danych przechowujemy stringa odzielonego ; Należy go przekonwertować na array aby bez problemu korzystał
        # z pola choices w formularzu
        return explode(';', $this->weryfikacjaEfektowUczenia);
    }

    public function setWeryfikacjaEfektowUczenia(?array $weryfikacjaEfektowUczenia): self
    {

        $this->weryfikacjaEfektowUczenia = implode("; ", $weryfikacjaEfektowUczenia);

        return $this;
    }

    public function getDokumentacjaEfektowUczenia(): ?array
    {
        # w bazie danych przechowujemy stringa odzielonego ; Należy go przekonwertować na array aby bez problemu korzystał
        # z pola choices w formularzu
        return explode(';', $this->dokumentacjaEfektowUczenia);
    }

    public function setDokumentacjaEfektowUczenia(?array $dokumentacjaEfektowUczenia): self
    {
        $this->dokumentacjaEfektowUczenia = implode("; ", $dokumentacjaEfektowUczenia);

        return $this;
    }

    public function getKryteriaOceniania(): ?string
    {
        return $this->kryteriaOceniania;
    }

    public function setKryteriaOceniania(?string $kryteriaOceniania): self
    {
        $this->kryteriaOceniania = $kryteriaOceniania;

        return $this;
    }

    public function getStatusPodstawowe(): ?bool
    {
        return $this->statusPodstawowe;
    }

    public function setStatusPodstawowe(?bool $statusPodstawowe): self
    {
        $this->statusPodstawowe = $statusPodstawowe;

        return $this;
    }

    public function getStatusObowiazkowe(): ?bool
    {
        return $this->statusObowiazkowe;
    }

    public function setStatusObowiazkowe(?bool $statusObowiazkowe): self
    {
        $this->statusObowiazkowe = $statusObowiazkowe;

        return $this;
    }

    public function getUwagi(): ?string
    {
        return $this->uwagi;
    }

    public function setUwagi(?string $uwagi): self
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    public function getMiejsceRealizacji(): ?MiejsceRealizacji
    {
        return $this->miejsceRealizacji;
    }

    public function setMiejsceRealizacji(?MiejsceRealizacji $miejsceRealizacji): self
    {
        $this->miejsceRealizacji = $miejsceRealizacji;

        return $this;
    }

    public function getGodziny()
    {
        return $this->godziny;
    }

    public function setGodziny($godziny): self
    {
        $this->godziny = $godziny;

        return $this;
    }

    /**
     * @return Collection|Literatura[]
     */
    public function getLiteratura(): Collection
    {
        return $this->literatura;
    }

    public function addLiteratura(Literatura $literatura): self
    {
        if (!$this->literatura->contains($literatura)) {
            $this->literatura[] = $literatura;
        }

        return $this;
    }

    public function removeLiteratura(Literatura $literatura): self
    {
        if ($this->literatura->contains($literatura)) {
            $this->literatura->removeElement($literatura);
        }

        return $this;
    }

    public function __toString(){
        return $this->nazwaPolska;
    }
}
