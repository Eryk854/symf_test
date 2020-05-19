<?php

namespace App\DataFixtures;

use App\Entity\Uzytkownik;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UzytkownikFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUzytkownicy($manager);
        $this->loadAdmin($manager);
        $this->loadKoordynatorzy($manager);
        $this->loadProwadzacy($manager);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadKoordynatorzy(ObjectManager $manager)
    {
        for ($x = 1; $x <= 2; $x++) {
            $user = new Uzytkownik();
            $user->setLogin('manager' . $x);
            $user->setImie('manager' . $x);
            $user->setEmail('manager' . $x . '@sggw.edu.pl');
            $user->setRoles(array('ROLE_TUTOR'));
            $user->addKoordynowaneSylabusy($this->getReference('sylabus1'));
            $user->addKoordynowaneSylabusy($this->getReference('sylabus2'));
            $user->addKoordynowaneSylabusy($this->getReference('sylabus3'));
            $user->addKoordynowaneSylabusy($this->getReference('sylabus4'));
            $user->addKoordynowaneSylabusy($this->getReference('sylabus5'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'manager' . $x
            ));
            $manager->persist($user);
        }
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadProwadzacy(ObjectManager $manager)
    {
        for ($x = 1; $x <= 2; $x++) {
            $user = new Uzytkownik();
            $user->setLogin('user' . $x);
            $user->setImie('user' . $x);
            $user->setEmail('user' . $x . '@sggw.edu.pl');
            $user->setRoles(array('ROLE_TUTOR'));
            $user->addProwadzoneSylabusy($this->getReference('sylabus1'));
            $user->addProwadzoneSylabusy($this->getReference('sylabus2'));
            $user->addProwadzoneSylabusy($this->getReference('sylabus3'));
            $user->addProwadzoneSylabusy($this->getReference('sylabus4'));
            $user->addProwadzoneSylabusy($this->getReference('sylabus5'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'user' . $x
            ));
            $manager->persist($user);
        }
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadAdmin(ObjectManager $manager)
    {
        $user = new Uzytkownik();
        $user->setLogin('admin');
        $user->setImie('admin');
        $user->setEmail('admin@admin');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $manager->persist($user);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadUzytkownicy(ObjectManager $manager)
    {
        $password = 'zaq12wsx';

        $listaImion = array(
            'Leszek',
            'Marcin',
            'Alina',
            'Krzysztof',
            'Waldemar'
        );
        $listaNazwisk = array(
            'Chmielewski',
            'Dudziński',
            'Jóźwikowska',
            'Karpio',
            'Karwowski',
        );

        for ($x = 0; $x < count($listaImion); $x++) {
            $user = new Uzytkownik();
            $user->setLogin($listaImion[$x] . $x);
            $user->setImie($listaImion[$x]);
            $user->setNazwisko($listaNazwisk[$x]);
            $user->setEmail($listaImion[$x] . '.' . $listaNazwisk[$x] . '@sggw.edu.pl');
            $user->setRoles(array('ROLE_USER'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $password
            ));
            $manager->persist($user);
        }
    }

    public function getDependencies()
    {
        return array(
            SylabusFixture::class,
        );
    }
}
