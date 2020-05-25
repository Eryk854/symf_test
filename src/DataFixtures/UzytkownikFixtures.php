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
        $user = new Uzytkownik();
        $user->setLogin('manager1');
        $user->setImie('manager1');
        $user->setEmail('manager1' . '@sggw.edu.pl');
        $user->setRoles(array('ROLE_TUTOR'));

        for ($program = 1; $program <= 2; $program++) {
            for ($sem = 1; $sem <= SylabusFixture::liczbaSemestrowNaProgram; $sem++) {
                for ($i = 1; $i <= SylabusFixture::liczbaSylabusowNaSemestr; $i++) {
                    $user->addKoordynowaneSylabusy($this->getReference('sylabus' . $program . $sem . $i));
                }
            }
        }
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'manager1'
        ));

        $user2 = new Uzytkownik();
        $user2->setLogin('manager2');
        $user2->setImie('manager2');
        $user2->setEmail('manager2' . '@sggw.edu.pl');
        $user2->setRoles(array('ROLE_TUTOR'));
        for ($program = 3; $program <= 4; $program++) {
            for ($sem = 1; $sem <= SylabusFixture::liczbaSemestrowNaProgram; $sem++) {
                for ($i = 1; $i <= SylabusFixture::liczbaSylabusowNaSemestr; $i++) {
                    $user->addKoordynowaneSylabusy($this->getReference('sylabus' . $program . $sem . $i));
                }
            }
        }
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'manager2'
        ));

        $manager->persist($user);
        $manager->persist($user2);
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

            for ($program = 1; $program <= SylabusFixture::liczbaProgramow; $program++) {
                for ($sem = 1; $sem <= SylabusFixture::liczbaSemestrowNaProgram; $sem++) {
                    for ($i = 1; $i <= SylabusFixture::liczbaSylabusowNaSemestr; $i++) {
                        $user->addProwadzoneSylabusy($this->getReference('sylabus' . $program . $sem . $i));
                    }
                }
            }
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
