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
        $sylabus1->setProgram($this->getReference('program'));


        $sylabus2 = new Sylabus();
        $sylabus2->setNumerKatalogowy('ZIM-IN-2S-04L-32');
        $sylabus2->setZajecia($this->getReference('zajecia2'));
        $sylabus1->setProgram($this->getReference('program2'));

        $manager->persist($sylabus1);
        $manager->persist($sylabus2);

        $this->addReference('sylabus1', $sylabus1);
        $this->addReference('sylabus2', $sylabus2);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ZajeciaFixtures::class,
            ProgramFixtures::class,
        );
    }
}
