<?php

namespace App\Entity;

use App\Repository\GodzinyRepository;

class ProgramPodsumowanie
{
    private $nazwa_programu;
    private $wydzial;
    private $kierunek;
    private $typ;
    private $tryb;

    private $liczba_semestrow;

    private $sumy_ects_dla_semestru;
    private $sumy_ects_dla_status_zajec_podstawowe;
    private $sumy_ects_dla_status_zajec_kierunkowe;
    private $sumy_ects_dla_status_zajec_human;
    private $sumy_ects_dla_status_zajec_obligatoryjnych;
    private $sumy_ects_dla_status_zajec_do_wyboru;
    private $sumy_ects_dla_status_zajec_naukowe;
    private $sumy_ects_dla_status_zajec_praktyczne;

    private $sumy_godzin_dla_semestru;

    private $sumy_godzin_wyklad_dla_semestrow;
    private $sumy_godzin_cwiczenia_dla_semestrow;
    private $sumy_godzin_lab_dla_semestrow;
    private $sumy_godzin_teren_dla_semestrow;
    private $sumy_godzin_projekt_dla_semestrow;
    private $sumy_godzin_praktyki_dla_semestrow;

    private $liczba_zatwierdzonych_sylabusow;
    private $lista_niezatwierdzonych_sylabusow;

    /**
     * @return mixed
     */
    public function getNazwaProgramu(): ?string
    {
        return $this->nazwa_programu;
    }

    /**
     * @param mixed $nazwa_programu
     * @return ProgramPodsumowanie
     */
    public function setNazwaProgramu($nazwa_programu)
    {
        $this->nazwa_programu = $nazwa_programu;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWydzial(): ?string
    {
        return $this->wydzial;
    }

    /**
     * @param mixed $wydzial
     * @return ProgramPodsumowanie
     */
    public function setWydzial($wydzial)
    {
        $this->wydzial = $wydzial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKierunek(): ?string
    {
        return $this->kierunek;
    }

    /**
     * @param mixed $kierunek
     * @return ProgramPodsumowanie
     */
    public function setKierunek($kierunek)
    {
        $this->kierunek = $kierunek;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTyp(): ?string
    {
        return $this->typ;
    }

    /**
     * @param mixed $typ
     * @return ProgramPodsumowanie
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTryb(): ?string
    {
        return $this->tryb;
    }

    /**
     * @param mixed $tryb
     * @return ProgramPodsumowanie
     */
    public function setTryb($tryb)
    {
        $this->tryb = $tryb;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLiczbaSemestrow(): ?int
    {
        return $this->liczba_semestrow;
    }

    /**
     * @param mixed $liczba_semestrow
     * @return ProgramPodsumowanie
     */
    public function setLiczbaSemestrow($liczba_semestrow)
    {
        $this->liczba_semestrow = $liczba_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaSemestru(): ?array
    {
        return $this->sumy_ects_dla_semestru;
    }

    /**
     * @param mixed $sumy_ects_dla_semestru
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaSemestru($sumy_ects_dla_semestru)
    {
        $this->sumy_ects_dla_semestru = $sumy_ects_dla_semestru;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecPodstawowe()
    {
        return $this->sumy_ects_dla_status_zajec_podstawowe;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_podstawowe
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecPodstawowe($sumy_ects_dla_status_zajec_podstawowe)
    {
        $this->sumy_ects_dla_status_zajec_podstawowe = $sumy_ects_dla_status_zajec_podstawowe;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecKierunkowe()
    {
        return $this->sumy_ects_dla_status_zajec_kierunkowe;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_kierunkowe
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecKierunkowe($sumy_ects_dla_status_zajec_kierunkowe)
    {
        $this->sumy_ects_dla_status_zajec_kierunkowe = $sumy_ects_dla_status_zajec_kierunkowe;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecHuman()
    {
        return $this->sumy_ects_dla_status_zajec_human;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_human
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecHuman($sumy_ects_dla_status_zajec_human)
    {
        $this->sumy_ects_dla_status_zajec_human = $sumy_ects_dla_status_zajec_human;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecObligatoryjnych()
    {
        return $this->sumy_ects_dla_status_zajec_obligatoryjnych;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_obligatoryjnych
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecObligatoryjnych($sumy_ects_dla_status_zajec_obligatoryjnych)
    {
        $this->sumy_ects_dla_status_zajec_obligatoryjnych = $sumy_ects_dla_status_zajec_obligatoryjnych;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecDoWyboru()
    {
        return $this->sumy_ects_dla_status_zajec_do_wyboru;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_do_wyboru
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecDoWyboru($sumy_ects_dla_status_zajec_do_wyboru)
    {
        $this->sumy_ects_dla_status_zajec_do_wyboru = $sumy_ects_dla_status_zajec_do_wyboru;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecNaukowe()
    {
        return $this->sumy_ects_dla_status_zajec_naukowe;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_naukowe
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecNaukowe($sumy_ects_dla_status_zajec_naukowe)
    {
        $this->sumy_ects_dla_status_zajec_naukowe = $sumy_ects_dla_status_zajec_naukowe;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyEctsDlaStatusZajecPraktyczne()
    {
        return $this->sumy_ects_dla_status_zajec_praktyczne;
    }

    /**
     * @param mixed $sumy_ects_dla_status_zajec_praktyczne
     * @return ProgramPodsumowanie
     */
    public function setSumyEctsDlaStatusZajecPraktyczne($sumy_ects_dla_status_zajec_praktyczne)
    {
        $this->sumy_ects_dla_status_zajec_praktyczne = $sumy_ects_dla_status_zajec_praktyczne;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getSumyGodzinDlaSemestru(): ?array
    {
        return $this->sumy_godzin_dla_semestru;
    }

    /**
     * @param mixed $sumy_godzin_dla_semestru
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinDlaSemestru($sumy_godzin_dla_semestru)
    {
        $this->sumy_godzin_dla_semestru = $sumy_godzin_dla_semestru;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyGodzinWykladDlaSemestrow(): ?array
    {
        return $this->sumy_godzin_wyklad_dla_semestrow;
    }

    /**
     * @param mixed $sumy_godzin_wyklad_dla_semestrow
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinWykladDlaSemestrow($sumy_godzin_wyklad_dla_semestrow)
    {
        $this->sumy_godzin_wyklad_dla_semestrow = $sumy_godzin_wyklad_dla_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyGodzinCwiczeniaDlaSemestrow(): ?array
    {
        return $this->sumy_godzin_cwiczenia_dla_semestrow;
    }

    /**
     * @param mixed $sumy_godzin_cwiczenia_dla_semestrow
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinCwiczeniaDlaSemestrow($sumy_godzin_cwiczenia_dla_semestrow)
    {
        $this->sumy_godzin_cwiczenia_dla_semestrow = $sumy_godzin_cwiczenia_dla_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyGodzinLabDlaSemestrow(): ?array
    {
        return $this->sumy_godzin_lab_dla_semestrow;
    }

    /**
     * @param mixed $sumy_godzin_lab_dla_semestrow
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinLabDlaSemestrow($sumy_godzin_lab_dla_semestrow)
    {
        $this->sumy_godzin_lab_dla_semestrow = $sumy_godzin_lab_dla_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyGodzinTerenDlaSemestrow(): ?array
    {
        return $this->sumy_godzin_teren_dla_semestrow;
    }

    /**
     * @param mixed $sumy_godzin_teren_dla_semestrow
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinTerenDlaSemestrow($sumy_godzin_teren_dla_semestrow)
    {
        $this->sumy_godzin_teren_dla_semestrow = $sumy_godzin_teren_dla_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyGodzinProjektDlaSemestrow(): ?array
    {
        return $this->sumy_godzin_projekt_dla_semestrow;
    }

    /**
     * @param mixed $sumy_godzin_projekt_dla_semestrow
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinProjektDlaSemestrow($sumy_godzin_projekt_dla_semestrow)
    {
        $this->sumy_godzin_projekt_dla_semestrow = $sumy_godzin_projekt_dla_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSumyGodzinPraktykiDlaSemestrow(): ?array
    {
        return $this->sumy_godzin_praktyki_dla_semestrow;
    }

    /**
     * @param mixed $sumy_godzin_praktyki_dla_semestrow
     * @return ProgramPodsumowanie
     */
    public function setSumyGodzinPraktykiDlaSemestrow($sumy_godzin_praktyki_dla_semestrow)
    {
        $this->sumy_godzin_praktyki_dla_semestrow = $sumy_godzin_praktyki_dla_semestrow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLiczbaZatwierdzonychSylabusow(): ?int
    {
        return $this->liczba_zatwierdzonych_sylabusow;
    }

    /**
     * @param mixed $liczba_zatwierdzonych_sylabusow
     * @return ProgramPodsumowanie
     */
    public function setLiczbaZatwierdzonychSylabusow($liczba_zatwierdzonych_sylabusow)
    {
        $this->liczba_zatwierdzonych_sylabusow = $liczba_zatwierdzonych_sylabusow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListaNiezatwierdzonychSylabusow(): ?array
    {
        return $this->lista_niezatwierdzonych_sylabusow;
    }

    /**
     * @param mixed $lista_niezatwierdzonych_sylabusow
     * @return ProgramPodsumowanie
     */
    public function setListaNiezatwierdzonychSylabusow($lista_niezatwierdzonych_sylabusow)
    {
        $this->lista_niezatwierdzonych_sylabusow = $lista_niezatwierdzonych_sylabusow;
        return $this;
    }




}
