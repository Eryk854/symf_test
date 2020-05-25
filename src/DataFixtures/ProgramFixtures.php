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
        $program->setOpis('Informatyka 1 stopień stacjonarne 2019/2020');
        $program->setRokAkademicki('2019/2020');
        $program->setFormaStudiow("Stacjonarne");
        $program->setPoziomStudiow("1 stopień");
        $program->setKierunek($this->getReference('kierunek1'));

        $program2 = new Program();
        $program2->setOpis('Informatyka 1 stopień niestacjonarne 2019/2020');
        $program2->setRokAkademicki('2019/2020');
        $program2->setFormaStudiow("Niestacjonarne");
        $program2->setPoziomStudiow("1 stopień");
        $program2->setKierunek($this->getReference('kierunek1'));

        $program3 = new Program();
        $program3->setOpis('Informatyka 1 stopień stacjonarne 2018/2019');
        $program3->setRokAkademicki('2018/2019');
        $program3->setFormaStudiow("Stacjonarne");
        $program3->setPoziomStudiow("1 stopień");
        $program3->setKierunek($this->getReference('kierunek1'));

        $program4 = new Program();
        $program4->setOpis('Informatyka 1 stopień niestacjonarne 2018/2019');
        $program4->setRokAkademicki('2018/2019');
        $program4->setFormaStudiow("Niestacjonarne");
        $program4->setPoziomStudiow("1 stopień");
        $program4->setKierunek($this->getReference('kierunek1'));


        $manager->persist($program);
        $manager->persist($program2);
        $manager->persist($program3);
        $manager->persist($program4);

        $this->addReference('program1', $program);
        $this->addReference('program2', $program2);
        $this->addReference('program3', $program3);
        $this->addReference('program4', $program4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            KierunekFixtures::class
        );
    }
}
