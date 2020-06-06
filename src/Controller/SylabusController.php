<?php

namespace App\Controller;

#use http\Env\Request;
use App\Entity\Godziny;
use App\Entity\Instytucja;
use App\Entity\Program;
use App\Entity\Semestr;
use App\Entity\Sylabus;
use App\Entity\Uzytkownik;
use App\Entity\Zajecia;

use App\Forms\Type\HourType;
use App\Forms\Type\NowySylabusType;
use App\Forms\Type\ZajeciaType;

use App\Forms\Type\SylabusType;
use App\Repository\SylabusRepository;
use App\Security\Voter\EditSylabusVoter;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SylabusController extends AbstractController
{
    /**
     * @Route("/sylabus/{query}", name="sylabus", methods={"GET"})
     */
    public function index($query, SylabusRepository $sylabus_repository): Response
    {
        $instytucja_repository = $this->getDoctrine()->getRepository(Instytucja::class);
        $zajecia_repository = $this->getDoctrine()->getRepository(Zajecia::class);
        $sylabus = $sylabus_repository->find($query);

        $instyctucja = $instytucja_repository->find($sylabus->getJednostkaRealizujaca());

        $zajecia = $zajecia_repository->find($sylabus->getZajecia());

        $koordynator = $sylabus->getKoordynatorZajec();

        $prowadzacy = $sylabus->getProwadzacyZajecia();

        $numer_katalogowy = $sylabus->getNumerKatalogowy();

        $jednostka_realizujaca = $instyctucja->getNazwaSkrocona();

        $jednostka_zlecajaca = $instyctucja->getNazwaSkrocona();

        $nazwa_zajec_pl = $zajecia->getNazwaPolska();

        $nazwa_zajec_en = $zajecia->getNazwaAngielska();

        $jezyk_wykladowy = $zajecia->getJezykWykladowy();

        $zajecia_temp = new Zajecia();
        $zajecia_temp->setGodziny($zajecia->getGodziny());
        $godziny = $zajecia_temp->getGodziny();

        $zalozenia = $zajecia->getZalozenia();

        $cele = $zajecia->getCele();

        $opis_zajec = $zajecia->getOpis();

        $zakres_tematow = $zajecia->getZakresTematow();

        $metody_dydaktyczne = $zajecia->getMetodyDydaktyczne();

        $wymagania_formalne = $zajecia->getWymaganiaFormalne();

        $zalozenia_wstepne = $zajecia->getZalozeniaWstepne();

        $zajecia_temp->setEfektyUczenia($zajecia->getEfektyUczenia());
        $efekty_uczenia = $zajecia_temp->getEfektyUczenia();

        $weryfikacja_efektow_uczenia = $zajecia->getWeryfikacjaEfektowUczenia();

        $metody_dokumentacji_efektow_uczenia = $zajecia->getDokumentacjaEfektowUczenia();

        $kryteria_oceniania = $zajecia->getKryteriaOceniania();

        $status_podstawowe = $zajecia->getStatusPodstawowe();

        $status_obowiazkowe = $zajecia->getStatusObowiazkowe();

        $uwagi = $zajecia->getUwagi();

        $zajecia_temp->setMiejsceRealizacji($zajecia->getMiejsceRealizacji());
        $miejsce_realizacji = $zajecia_temp->getMiejsceRealizacji();

        $podstawowa_literatura = $zajecia->getLiteratura();



        return $this->render('sylabus/index.html.twig', [
            'id' => $sylabus->getId(),
            'sylabus' => $sylabus,
            'koordynator' => $koordynator,
            'prowadzacy' => $prowadzacy,
            'numer_katalogowy' => $numer_katalogowy,
            'jednostka_realizujaca' => $jednostka_realizujaca,
            'jednostka_zlecajaca' => $jednostka_zlecajaca,
            'nazwa_zajec_pl' => $nazwa_zajec_pl,
            'nazwa_zajec_en' => $nazwa_zajec_en,
            'jezyk_wykladowy' => $jezyk_wykladowy,
            'godziny' => $godziny,
            'zalozenia' => $zalozenia,
            'cele' => $cele,
            'opis_zajec' => $opis_zajec,
            'zakres_tematow' => $zakres_tematow,
            'metody_dydaktyczne' => $metody_dydaktyczne,
            'wymagania_formalne' => $wymagania_formalne,
            'zalozenia_wstepne' => $zalozenia_wstepne,
            'efekty_uczenia' => $efekty_uczenia,
            'weryfikacja_efektow_uczenia' => $weryfikacja_efektow_uczenia,
            'metody_dokumentacji_efektow_uczenia' => $metody_dokumentacji_efektow_uczenia,
            'kryteria_oceniania' => $kryteria_oceniania,
            'status_podstawowe' => $status_podstawowe,
            'status_obowiazkowe' => $status_obowiazkowe,
            'uwagi' => $uwagi,
            'miejsce_realizacji' => $miejsce_realizacji,
            'podstawowa_literatura' => $podstawowa_literatura,
        ]);
    }

    /**
     * @Route("sylabus/form/{id}", name="sylabusForm")
     */
    public function number(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager(); # polaczenie do bazy

        $sylabus = $this->getDoctrine()->getRepository(Sylabus::class)->find($id); #bierzemy z bazy sylabus po id względem url

        $this->denyAccessUnlessGranted(EditSylabusVoter::SYLABUS_EDIT, $sylabus);

        $nazwa_zajec_polska = $this->getDoctrine()->getRepository(Zajecia::class)->find($sylabus->getZajecia()->getId())->getNazwaPolska();
        $program_id = $sylabus->getProgram()->getId();

        $rok_akademicki = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getRokAkademicki();
        $forma_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getFormaStudiow();
        $poziom_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getPoziomStudiow();

        $form = $this->createForm(SylabusType::class, $sylabus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $sylabus = $form->getData();
            if($form->get('confirm')->isClicked())
            {
                //sprawdzamy czy chcemy zatwierdzić sylabus
                $sylabus->setZatwierdzony(true);
            }

            $godz = $sylabus->getZajecia()->getGodziny();
            $efekty = $sylabus->getZajecia()->getEfektyUczenia();

            //tworzymy fikcyjny sylabus1, który zostanie najpierw wrzucony do bazy danych aby w polach z entity wstawić null
            $sylabus1 = $this->getDoctrine()->getRepository(Sylabus::class)->find($id);
            $sylabus1->getZajecia()->setGodziny(Null);
            $sylabus1->getZajecia()->setEfektyUczenia(Null);

            // wrzucenie fikcyjnego sylabusa do bazy
            $entityManager->persist($sylabus1);
            $entityManager->flush();

            //wrzucenie prawdziwego sylabusa do bazy
            $entityManager->persist($sylabus);
            $entityManager->flush();

            // wrzucenie zajec zawierajacego nasze entity do bazy
            $zajecia = $this->getDoctrine()->getRepository(Sylabus::class)->find($sylabus->getId())->getZajecia();
            $zajecia->setGodziny($godz);
            $zajecia->setEfektyUczenia($efekty);

            $entityManager->persist($zajecia);
            $entityManager->flush();

            if($form->get('confirm')->isClicked())
            {
                return $this->redirectToRoute('sylabus', ['query' => $id]);
            }


        }
        return $this->render('sylabus/sylabus.html.twig', [
            'form' => $form->createView(),
            'nazwa' => $nazwa_zajec_polska,
            'rok_akademicki' => $rok_akademicki,
            'poziom_studiow' => $poziom_studiow,
            'forma_studiow' => $forma_studiow,
        ]);
    }

    /**
     * @Route("sylabus/new/{program_id}", name="nowy_sylabus")
     */
    public function new(Request $request, $program_id)
    {
        $entityManager = $this->getDoctrine()->getManager(); # polaczenie do bazy

        $rok_akademicki = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getRokAkademicki();
        $forma_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getFormaStudiow();
        $poziom_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getPoziomStudiow();
        $opis_programu = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getOpis();

        $form = $this->createForm(NowySylabusType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $sylabus = $form->getData();
            $podobne_przedmioty = $this->getDoctrine()->getRepository(Zajecia::class)->findByFieldNazwaPolska($sylabus['nazwa']);

            // na podstawie id kazdego przedmiotu pobieram z jego sylabusa program a z programu rok stopień i formę studiów
            $dane = array();
            for ($i = 0; $i < count($podobne_przedmioty); $i++) {
                $program_przedmiotu = $this->getDoctrine()->getRepository(Sylabus::class)->findOneByZajecia($podobne_przedmioty[$i])->getProgram();
                array_push($dane, array(
                    'forma_studiow' => $program_przedmiotu->getFormaStudiow(),
                    'rok_akademicki' => $program_przedmiotu->getRokAkademicki(),
                    'poziom_studiow' => $program_przedmiotu->getPoziomStudiow(),
                ));
            }
            return $this->render('sylabus/nowy_sylabus.html.twig', [
                'form' => $form->createView(),
                'rok_akademicki' => $rok_akademicki,
                'poziom_studiow' => $poziom_studiow,
                'forma_studiow' => $forma_studiow,
                'przedmioty' => $podobne_przedmioty,
                'program_id' => $program_id,
                'opis_programu' => $opis_programu,
                'dane' => $dane,
                'nazwa' => $sylabus['nazwa']
            ]);
        }

        return $this->render('sylabus/nowy_sylabus.html.twig', [
            'form' => $form->createView(),
            'rok_akademicki' => $rok_akademicki,
            'opis_programu' => $opis_programu,
            'poziom_studiow' => $poziom_studiow,
            'forma_studiow' => $forma_studiow,
        ]);
    }

    /**
     * @Route("/sylabus/make/", name="make_sylabus")
     */
    public function make(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager(); # polaczenie do bazy

        $program_id = $request->request->get('program_id');
        $program = $this->getDoctrine()->getRepository(Program::class)->find($program_id);

        // użytkownik który tworzy sylabus jest automatycznie przypisywany jako jego koordynator
        $user_id = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(Uzytkownik::class)->find($user_id);
        if ($request->request->get('przedmiot_id')) {
            // użytkownik chce zduplikować istniejący sylabus
            $przedmiot_duplikat_id = $request->request->get('przedmiot_id');

            // duplikacja przedmiotu, który chcemy i zapisanie go w tabeli zajecia
            $przedmiot_duplikat = $this->getDoctrine()->getRepository(Zajecia::class)->find($przedmiot_duplikat_id);
            $przedmiot = clone $przedmiot_duplikat;
            $entityManager->detach($przedmiot);
            $entityManager->persist($przedmiot);
            $entityManager->flush();

            // stworzenie sylabusa odwołującego się do tych zajęć w danym programie studiów
            $sylabus = new Sylabus();
            $sylabus->setZajecia($przedmiot);
            $sylabus->setProgram($program);
            $sylabus->setKoordynatorZajec($user);
            $entityManager->persist($sylabus);
            $entityManager->flush();

            //przekierowanie do wypełniania tego sylabusa
            return $this->redirectToRoute('sylabusForm', ['id' => $sylabus->getId()]);
        } else {
            //użytkownik tworzy całkiem nowy sylabus bez duplikacji danych
            $nazwa = $request->request->get('nazwa');

            $godziny = new Godziny();
            $godziny->setECTS(0);
            $godziny->setGodzinyCwiczeniowe(0);
            $godziny->setGodzinyWykladowe(0);


            $zajecia = new Zajecia();
            $zajecia->setNazwaPolska($nazwa);
            $entityManager->persist($zajecia);
            $zajecia->setGodziny($godziny);
            $zajecia->setKryteriaOceniania('');
            $entityManager->flush();

            $instytucja = $this->getDoctrine()->getRepository(Instytucja::class)->findAll();
            $sylabus = new Sylabus();
            $sylabus->setZajecia($zajecia);
            $sylabus->setProgram($program);
            $sylabus->setJednostkaRealizujaca($instytucja[0]);
            $sylabus->setJednostkaZlecajaca($instytucja[0]);
            $semestr = $this->getDoctrine()->getRepository(Semestr::class)->findAll();
            dump($semestr);

            $sylabus->setSemestr($semestr[0]);
            $sylabus->setKoordynatorZajec($user);

            $entityManager->persist($sylabus);
            $entityManager->flush();

            return $this->redirectToRoute('sylabusForm', ['id' => $sylabus->getId()]);

        }
    }

}
