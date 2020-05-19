<?php

namespace App\DataFixtures;

use App\Entity\Kierunek;
use App\Entity\Program;
use App\Entity\Semestr;
use App\Entity\Sylabus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setOpis('opis1');
        $program->setRokAkademicki(1998);
        $program->setFormaStudiow("Stacjonarne");
        $program->setPoziomStudiow("1 stopnia");
        $program->setSemestr($this->getReference('semestr1'));
        $program->setKierunek($this->getReference('kierunek1'));

        $program2 = new Program();
        $program2->setOpis('opis2');
        $program2->setRokAkademicki(2000);
        $program2->setFormaStudiow("Niestacjonare");
        $program2->setPoziomStudiow("2 stopnia");
        $program2->setSemestr($this->getReference('semestr2'));
        $program2->setKierunek($this->getReference('kierunek2'));

        $program3 = new Program();
        $program3->setOpis('opis3');
        $program3->setRokAkademicki(2017);
        $program3->setFormaStudiow("Stacjonarne");
        $program3->setPoziomStudiow("1 stopnia");
        $program3->setSemestr($this->getReference('semestr3'));
        $program3->setKierunek($this->getReference('kierunek1'));

        $program4 = new Program();
        $program4->setOpis('opis4');
        $program4->setRokAkademicki(2017);
        $program4->setFormaStudiow("Niestacjonare");
        $program4->setPoziomStudiow("2 stopnia");
        $program4->setSemestr($this->getReference('semestr4'));
        $program4->setKierunek($this->getReference('kierunek2'));

        $program5 = new Program();
        $program5->setOpis('opis5');
        $program5->setRokAkademicki(1998);
        $program5->setFormaStudiow("Niestacjonare");
        $program5->setPoziomStudiow("1 stopnia");
        $program5->setSemestr($this->getReference('semestr5'));
        $program5->setKierunek($this->getReference('kierunek1'));

        $program6 = new Program();
        $program6->setOpis('opis6');
        $program6->setRokAkademicki(2017);
        $program6->setFormaStudiow("Stacjonarne");
        $program6->setPoziomStudiow("2 stopnia");
        $program6->setSemestr($this->getReference('semestr6'));
        $program6->setKierunek($this->getReference('kierunek2'));

        $manager->persist($program);
        $manager->persist($program2);
        $manager->persist($program3);
        $manager->persist($program4);
        $manager->persist($program5);
        $manager->persist($program6);

        $this->addReference('program1', $program);
        $this->addReference('program2', $program2);
        $this->addReference('program3', $program3);
        $this->addReference('program4', $program4);
        $this->addReference('program5', $program5);
        $this->addReference('program6', $program6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            KierunekFixtures::class,
            SemestrFixtures::class
        );
    }
}
