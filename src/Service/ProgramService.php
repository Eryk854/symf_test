<?php


namespace App\Service;


use App\Entity\ProgramPodsumowanie;
use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\Collection;

class ProgramService
{
    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    public function stworzPodsumowanie(int $idProgramu): ProgramPodsumowanie
    {
        $podsumowanie = new ProgramPodsumowanie();

        $program = $this->programRepository->find($idProgramu);

        if (is_null($program))
            return $podsumowanie;

        $sylabusy = $program->getSylabusy();
        $numerySemestrow = $this->getNumerySemestrów($sylabusy);
        $maxSemestr = max($numerySemestrow);

        $podsumowanie
            ->setNazwaProgramu($program->getOpis())
            ->setWydzial($program->getKierunek()->getWydzial())
            ->setKierunek($program->getKierunek()->getNazwa())
            ->setTyp($program->getPoziomStudiow())
            ->setTryb($program->getFormaStudiow())
            ->setLiczbaSemestrow($maxSemestr);

        $this->setSumyDlaKazdegoSemestru($podsumowanie, $maxSemestr, $sylabusy);

        $podzielonaKolekcja = $sylabusy->partition(function ($key, $sylabus) {
            return $sylabus->getZatwierdzony() === true;
        });
        $zatwierdzoneSylabusy = $podzielonaKolekcja[0];
        $niezatwierdzoneSylabusy = $podzielonaKolekcja[1]->toArray();

        $podsumowanie
            ->setLiczbaZatwierdzonychSylabusow(sizeof($zatwierdzoneSylabusy))
            ->setListaNiezatwierdzonychSylabusow($niezatwierdzoneSylabusy);

        return $podsumowanie;
    }


    private function setSumyDlaKazdegoSemestru($podsumowanie, $maxSemestr, $sylabusy): void
    {
        $sumy_ects_dla_semestru = array();
        $sumy_godzin_dla_semestru = array();
        $tablica_sumy_ects = array();
        $tablica_sumy_godzin = array();
        $filtryStatusZajec = $this->getFiltryStatusZajec();

        for ($semestr = 1; $semestr <= $maxSemestr; $semestr++) {
            $sumy_ects = array();
            $sumy_godzin = array();
            $sylabusyNaSemestrzeX = $this->getSylabusyNaSemestrze($sylabusy, $semestr);

            //Sekcja: Sumy punktów ECTS w podziale na status zajęć (uwzględniając status I, II oraz III).
            for ($filtrIdx = 0; $filtrIdx < sizeof($filtryStatusZajec); $filtrIdx++) {
                $sylabusyPoFiltrze = $sylabusyNaSemestrzeX->filter($filtryStatusZajec[$filtrIdx]);
                array_push($sumy_ects, array_sum($this->getEcts($sylabusyPoFiltrze)));
            }
            //Dodaje tablice sum ectsów dla semestru (kolejnosc filtrów wynaczona w funkcji getFiltryStatusZajec())
            array_push($tablica_sumy_ects, $sumy_ects);

            //Sekcja: Sumy godzin dla każdego z semestrów w podziale na: wykłady/ćwiczenia, itd. (W, C, LC, PC, TC, ZP).
            array_push($sumy_godzin, array_sum($this->getGodzinyWykladowe($sylabusyNaSemestrzeX)));
            array_push($sumy_godzin, array_sum($this->getGodzinyCwiczeniowe($sylabusyNaSemestrzeX)));
            array_push($sumy_godzin, array_sum($this->getGodzinyPraktyki($sylabusyNaSemestrzeX)));
            array_push($sumy_godzin, array_sum($this->getGodzinyLaboratoryjne($sylabusyNaSemestrzeX)));
            array_push($sumy_godzin, array_sum($this->getGodzinyProjektowe($sylabusyNaSemestrzeX)));
            array_push($sumy_godzin, array_sum($this->getGodzinyTerenowe($sylabusyNaSemestrzeX)));

            //Dodaje tablice sum godzin dla semestru
            array_push($tablica_sumy_godzin, $sumy_godzin);

            //Sekcja: Sumy punktów ECTS dla każdego z semestrów.
            $godziny = $this->getKolekcjeGodzin($sylabusyNaSemestrzeX);
            $ectsy = $godziny->map(function ($godzina) {
                return $godzina->getECTS();
            });
            array_push($sumy_ects_dla_semestru, array_sum($ectsy->toArray()));

            //Sekcja: Sumy godzin dla każdego z semestrów.
            $suma_godzin = $godziny->map(function ($godzina) {
                return $godzina->getSumaGodzin();
            });
            array_push($sumy_godzin_dla_semestru, array_sum($suma_godzin->toArray()));

        }

        $tablica_sumy_ects = array_map(null, ...$tablica_sumy_ects);
        $tablica_sumy_godzin = array_map(null, ...$tablica_sumy_godzin);
        $podsumowanie
            ->setSumyEctsDlaSemestru($sumy_ects_dla_semestru)
            ->setSumyGodzinDlaSemestru($sumy_godzin_dla_semestru)
            ->setSumyEctsDlaStatusZajecPodstawowe($tablica_sumy_ects[0])
            ->setSumyEctsDlaStatusZajecKierunkowe($tablica_sumy_ects[1])
            ->setSumyEctsDlaStatusZajecHuman($tablica_sumy_ects[2])
            ->setSumyEctsDlaStatusZajecObligatoryjnych($tablica_sumy_ects[3])
            ->setSumyEctsDlaStatusZajecDoWyboru($tablica_sumy_ects[4])
            ->setSumyEctsDlaStatusZajecNaukowe($tablica_sumy_ects[5])
            ->setSumyEctsDlaStatusZajecPraktyczne($tablica_sumy_ects[6])
            ->setSumyGodzinWykladDlaSemestrow($tablica_sumy_godzin[0])
            ->setSumyGodzinCwiczeniaDlaSemestrow($tablica_sumy_godzin[1])
            ->setSumyGodzinPraktykiDlaSemestrow($tablica_sumy_godzin[2])
            ->setSumyGodzinLabDlaSemestrow($tablica_sumy_godzin[3])
            ->setSumyGodzinProjektDlaSemestrow($tablica_sumy_godzin[4])
            ->setSumyGodzinTerenDlaSemestrow($tablica_sumy_godzin[5]);
    }

    private function getSylabusyNaSemestrze($sylabusy, int $semestr)
    {
        return $sylabusyPoFiltrze = $sylabusy->filter(function ($sylabus) use ($semestr) {
            return $sylabus->getSemestr()->getNumerSemestru() === $semestr;
        });
    }

    private function getFiltryStatusZajec(): array
    {
        return [
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus1() === 'P';
            },
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus1() === 'K';
            },
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus1() === 'HS';
            },
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus2() === 'O';
            },
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus1() === 'F';
            },
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus3() === 'N';
            },
            function ($sylabus) {
                return $sylabus->getZajecia()->getStatus3() === 'U';
            }];
    }

    private function getKolekcjeGodzin($kolekcjaSylabusow): Collection
    {
        $godziny = $kolekcjaSylabusow->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny();
        });
        return $godziny;
    }

    private function getNumerySemestrów($sylabusy): array
    {
        $numerySemestrow = $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getSemestr()
                ->getNumerSemestru();
        });
        return $numerySemestrow->toArray();
    }

    private function getEcts($sylabusy): array
    {
        $godziny = $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny();
        });
        $ectsy = $godziny->map(function ($godzina) {
            return $godzina->getECTS();
        });
        return $ectsy->toArray();
    }

    private function getGodzinyWykladowe($sylabusy): array
    {
        return $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny()
                ->getGodzinyWykladowe();
        })->toArray();
    }

    private function getGodzinyProjektowe($sylabusy): array
    {
        return $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny()
                ->getGodzinyProjektowe();
        })->toArray();
    }

    private function getGodzinyTerenowe($sylabusy): array
    {
        return $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny()
                ->getGodzinyTerenowe();
        })->toArray();
    }

    private function getGodzinyPraktyki($sylabusy): array
    {
        return $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny()
                ->getGodzinyPraktyki();
        })->toArray();
    }

    private function getGodzinyCwiczeniowe($sylabusy): array
    {
        return $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny()
                ->getGodzinyCwiczeniowe();
        })->toArray();
    }

    private function getGodzinyLaboratoryjne($sylabusy): array
    {
        return $sylabusy->map(function ($sylabus) {
            return $sylabus
                ->getZajecia()
                ->getGodziny()
                ->getGodzinyLaboratoryjne();
        })->toArray();
    }
}