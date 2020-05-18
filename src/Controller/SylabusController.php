<?php

namespace App\Controller;

#use http\Env\Request;
use App\Entity\Godziny;
use App\Entity\Program;
use App\Entity\Sylabus;
use App\Entity\Zajecia;
use App\Forms\Type\HourType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Forms\Type\SylabusType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Entity\Instytucja;
use App\Entity\Uzytkownik;
use App\Repository\SylabusRepository;

/**
 * @Route("/sylabus")
 */
class SylabusController extends AbstractController
{
    /**
     * @Route("/sylabus/{query}", name="sylabus", methods={"GET"})
     */
    public function index($query, SylabusRepository $sylabus_repository) : Response
    {
        $instytucja_repository = $this->getDoctrine()->getRepository(Instytucja::class);
        $zajecia_repository = $this->getDoctrine()->getRepository(Zajecia::class);

        $sylabus = $sylabus_repository->find($query);
        $instyctucja = $instytucja_repository->find($sylabus->getJednostkaRealizujaca());
        $zajecia = $zajecia_repository->find($sylabus->getZajecia());

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
            'controller_name' => 'SylabusController',
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
     * @Route("/form/{id}", name="app_lucky_number")
     */
    public function number(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager(); # polaczenie do bazy

        $sylabus = $this->getDoctrine()->getRepository(Sylabus::class)->find($id); #bierzemy z bazy sylabus po id względem url
        $nazwa_zajec_polska = $this->getDoctrine()->getRepository(Zajecia::class)->find($sylabus->getZajecia()->getId())->getNazwaPolska();
        $program_id=$sylabus->getProgram()->getId();

        $rok_akademicki = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getRokAkademicki();
        $forma_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getFormaStudiow();
        $poziom_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getPoziomStudiow();

        $form = $this->createForm(SylabusType::class, $sylabus);
        dump($form);
        $form->handleRequest($request);
        dump($form);
        #$form_hour->handleRequest($request);

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        if ($form->isSubmitted() && $form->isValid())
        {

            $sylabus = $form->getData();
            #$godziny = $form_hour->getData();
            dump($sylabus);

            $entityManager->persist($sylabus);
            $entityManager->flush();

        }
        return $this->render('sylabus/sylabus.html.twig', [
            'form' => $form->createView(),
            'nazwa'=>$nazwa_zajec_polska,
            'rok_akademicki'=>$rok_akademicki,
            'poziom_studiow'=>$poziom_studiow,
            'forma_studiow'=>$forma_studiow,
        ]);
    }
}
