<?php

namespace App\DataFixtures;

use App\Entity\Sylabus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SylabusFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sylabus1 = new Sylabus();
        $sylabus1->setNumerKatalogowy('ZIM-IN-2S-04L-31');
        $sylabus1->setZajecia($this->getReference('zajecia1'));
        $sylabus1->setProgram($this->getReference('program1'));
        $sylabus1->setJednostkaRealizujaca($this->getReference('instytucja1'));
        $sylabus1->setJednostkaZlecajaca($this->getReference('instytucja2'));


        $sylabus2 = new Sylabus();
        $sylabus2->setNumerKatalogowy('ZIM-IN-2S-04L-32');
        $sylabus2->setZajecia($this->getReference('zajecia2'));
        $sylabus2->setProgram($this->getReference('program2'));
        $sylabus2->setJednostkaRealizujaca($this->getReference('instytucja3'));
        $sylabus2->setJednostkaZlecajaca($this->getReference('instytucja2'));

        $sylabus3 = new Sylabus();
        $sylabus3->setNumerKatalogowy('ZIM-IN-2S-04L-33');
        $sylabus3->setZajecia($this->getReference('zajecia3'));
        $sylabus3->setProgram($this->getReference('program2'));
        $sylabus3->setJednostkaRealizujaca($this->getReference('instytucja5'));
        $sylabus3->setJednostkaZlecajaca($this->getReference('instytucja1'));

        $sylabus4 = new Sylabus();
        $sylabus4->setNumerKatalogowy('ZIM-IN-2S-04L-34');
        $sylabus4->setZajecia($this->getReference('zajecia4'));
        $sylabus4->setProgram($this->getReference('program2'));
        $sylabus4->setJednostkaRealizujaca($this->getReference('instytucja2'));
        $sylabus4->setJednostkaZlecajaca($this->getReference('instytucja5'));

        $sylabus5 = new Sylabus();
        $sylabus5->setNumerKatalogowy('ZIM-IN-2S-04L-35');
        $sylabus5->setZajecia($this->getReference('zajecia5'));
        $sylabus5->setProgram($this->getReference('program1'));
        $sylabus5->setJednostkaRealizujaca($this->getReference('instytucja3'));
        $sylabus5->setJednostkaZlecajaca($this->getReference('instytucja4'));

        $sylabus6 = new Sylabus();
        $sylabus6->setNumerKatalogowy('ZIM-IN-2S-04L-36');
        $sylabus6->setZajecia($this->getReference('zajecia6'));
        $sylabus6->setProgram($this->getReference('program1'));
        $sylabus6->setJednostkaRealizujaca($this->getReference('instytucja3'));
        $sylabus6->setJednostkaZlecajaca($this->getReference('instytucja4'));

        $manager->persist($sylabus1);
        $manager->persist($sylabus2);
        $manager->persist($sylabus3);
        $manager->persist($sylabus4);
        $manager->persist($sylabus5);
        $manager->persist($sylabus6);

        $this->addReference('sylabus1', $sylabus1);
        $this->addReference('sylabus2', $sylabus2);
        $this->addReference('sylabus3', $sylabus3);
        $this->addReference('sylabus4', $sylabus4);
        $this->addReference('sylabus5', $sylabus5);
        $this->addReference('sylabus6', $sylabus6);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ZajeciaFixtures::class,
            ProgramFixtures::class,
            InstytucjaFixtures::class
        );
    }
}
