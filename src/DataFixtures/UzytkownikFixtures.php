<?php

namespace App\DataFixtures;

use App\Entity\Uzytkownik;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UzytkownikFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
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

        for ($x = 1; $x <= 2; $x++) {
            $user = new Uzytkownik();
            $user->setLogin('manager' . $x);
            $user->setImie('manager' . $x);
            $user->setEmail('manager' . $x . '@sggw.edu.pl');
            $user->setRoles(array('ROLE_USER'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'manager' . $x
            ));
            $manager->persist($user);
        }
        for ($x = 1; $x <= 2; $x++) {
            $user = new Uzytkownik();
            $user->setLogin('user' . $x);
            $user->setImie('user' . $x);
            $user->setEmail('user' . $x . '@sggw.edu.pl');
            $user->setRoles(array('ROLE_USER'));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'user' . $x
            ));
            $manager->persist($user);
        }

        $manager->persist($user);

        $manager->flush();
    }
}
