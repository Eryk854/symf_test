<?php

namespace App\DataFixtures;

use App\Entity\EfektyUczenia;
use App\Entity\Godziny;
use App\Entity\Literatura;
use App\Entity\MiejsceRealizacji;
use App\Entity\Zajecia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ZajeciaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($program = 1; $program <= SylabusFixture::liczbaProgramow; $program++) {
            for ($sem = 1; $sem <= SylabusFixture::liczbaSemestrowNaProgram; $sem++) {
                for ($i = 1; $i <= SylabusFixture::liczbaSylabusowNaSemestr; $i++) {
                    $this->decodeFromJson('zajecia' . $sem . $i, $manager, $program);
                }
            }
        }

        $manager->flush();
    }

    private function decodeFromJson($fileName, $manager, $suffix)
    {
        $strJsonFileContents = file_get_contents(__DIR__ . "/zajecia/" . $fileName . '.json');

        $array = json_decode($strJsonFileContents, true);
        $zajecia = new Zajecia();
        $zajecia->setCele($array["cele"]);

        $godziny = new Godziny();

        $godziny->setECTS($array["godziny"]["ects"]);
        $godziny->setGodzinyCwiczeniowe($array["godziny"]["cwiczenia"]);
        $godziny->setGodzinyWykladowe($array["godziny"]["wyklad"]);
        $godziny->setGodzinyLaboratoryjne($array["godziny"]["lab"]);
        $godziny->setGodzinyTerenowe($array["godziny"]["teren"]);
        $godziny->setGodzinyPraktyki($array["godziny"]["praktyki"]);
        $godziny->setGodzinyProjektowe($array["godziny"]["projekt"]);
        $zajecia->setGodziny($godziny);

        $zajecia->setDokumentacjaEfektowUczenia($array["efektyUczenia"]);

        $efektyUczenia = new EfektyUczenia();
        $efektyUczenia->setKompetencje($array["efektyUczenia"]["kompetencje"]);
        $efektyUczenia->setWiedza($array["efektyUczenia"]["wiedza"]);
        $efektyUczenia->setUmiejetnosci($array["efektyUczenia"]["umiejetnosci"]);
        $zajecia->setEfektyUczenia($efektyUczenia);

        $zajecia->setOpis($array["opis"]);
        $zajecia->setUwagi($array["uwagi"]);
        $zajecia->setZalozenia($array["zalozenia"]);
        $zajecia->setJezykWykladowy($array["jezykWykladowy"]);
        $zajecia->setKryteriaOceniania($array["kryteriaOceniania"]);
        $zajecia->setZakresTematow($array["zakresTematow"]);
        $zajecia->setZalozeniaWstepne($array["zalozeniaWstepne"]);
        $zajecia->setWymaganiaFormalne($array["wymaganiaFormalne"]);
        $zajecia->setMetodyDydaktyczne($array["metodyDydaktyczne"]);

        $miejsceRealizacji = new MiejsceRealizacji();
        $miejsceRealizacji->setCwiczenia($array["miejsceRealizacji"]["cwiczenia"]);
        $miejsceRealizacji->setWyklad($array["miejsceRealizacji"]["wyklad"]);
        $zajecia->setMiejsceRealizacji($miejsceRealizacji);

        $zajecia->setWeryfikacjaEfektowUczenia($array["weryfikacjaEfektowUczenia"]);
        $zajecia->setStatusPodstawowe($array["statusPodstawowe"]);
        $zajecia->setStatusObowiazkowe($array["statusObowiazkowe"]);
        if (array_key_exists("statusHumanistycznoSpoleczne", $array)) {
            $zajecia->setStatusHumanistycznoSpoleczne($array["statusHumanistycznoSpoleczne"]);
        } else {
            $zajecia->setStatusHumanistycznoSpoleczne(false);
        }
        if (array_key_exists("statusNaukowe", $array)) {
            $zajecia->setStatusNaukowe($array["statusNaukowe"]);
        }

        $zajecia->setNazwaPolska($array["nazwaPolska"]);
        $zajecia->setNazwaAngielska($array["nazwaAngielska"]);

        $literaturaArray = $array["literatura"];
        for ($i = 0; $i < sizeof($literaturaArray); $i++) {
            $literatura = new Literatura();
            $literatura->setAutor($literaturaArray[$i]["autor"]);
            $literatura->setRodzaj($literaturaArray[$i]["rodzaj"]);
            $literatura->setTytul($literaturaArray[$i]["tytul"]);
            $literatura->setWydawnictwo($literaturaArray[$i]["wydawnictwo"]);
            $manager->persist($literatura);

            $zajecia->addLiteratura($literatura);
        }
        $manager->persist($zajecia);
        $this->addReference($fileName . $suffix, $zajecia);
    }

    public function getDependencies()
    {
        return array(
            LiteraturaFixtures::class
        );
    }
}
