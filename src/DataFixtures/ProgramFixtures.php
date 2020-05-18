<?php

namespace App\DataFixtures;

use App\Entity\Kierunek;
use App\Entity\Program;
use App\Entity\Semestr;
use App\Entity\Sylabus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture
{
    private $passwordEncoder;

    public function load(ObjectManager $manager)
    {
        // Program1
        $program = new Program();
        $program->setOpis('opis1');
        $program->setRokAkademicki(1998);
        $program->setFormaStudiow("Stacjonarne");
        $program->setPoziomStudiow("1 stopnia");

        $semestr = new Semestr();
        $semestr->setNumerSemestru(1);
        $semestr->setRodzajSemestru("Zimowy");

        $program->setSemestr($semestr);

        $kierunek = new Kierunek();
        $kierunek->setInformacje("Informacje o kierunku");

        $program->setKierunek($kierunek);
        //
        $program2 = new Program();
        $program2->setOpis('opis2');
        $program2->setRokAkademicki(2000);
        $program2->setFormaStudiow("Niestacjonare");
        $program2->setPoziomStudiow("2 stopnia");

        $semestr2 = new Semestr();
        $semestr2->setNumerSemestru(2);
        $semestr2->setRodzajSemestru("Letni");

        $program2->setSemestr($semestr);

        $kierunek2 = new Kierunek();
        $kierunek2->setInformacje("Informacje o kierunku2");

        $program2->setKierunek($kierunek2);
        $manager->persist($program);
        $manager->persist($semestr);
        $manager->persist($kierunek);

        $manager->persist($program2);
        $manager->persist($semestr2);
        $manager->persist($kierunek2);

        $this->addReference('program', $program);
        $this->addReference('program2', $program2);

        $manager->flush();
    }
}
