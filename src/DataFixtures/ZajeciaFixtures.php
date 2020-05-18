<?php

namespace App\DataFixtures;

use App\Entity\EfektyUczenia;
use App\Entity\Godziny;
use App\Entity\MiejsceRealizacji;
use App\Entity\Zajecia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ZajeciaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $zajecia1 = new Zajecia();
        $zajecia1->setCele('Zaznajomienie studentów z zasadami programowania obiektowego
Przekazanie studentom wiedzy na temat podstawowych zasad obiektowej analizy dziedziny i projektowania klas 
Przekazanie studentom wiedzy o znaczeniu programowania obiektowego dla tworzenia dużych systemów
Nabycie przez studentów umiejętności posługiwania się środowiskiem programistycznym wspierającym programowanie obiektowe
Nabycie przez studentów umiejętności projektowania, implementowania, testowania i debugowania programów obiektowych a także właściwego wykorzystywania mechanizmów dziedziczenia, polimorfizmu i klas abstrakcyjnych.
');
        $godziny = new Godziny();
//        $godziny->setCzasPracyWlasnej();
        $godziny->setECTS(6);
        $godziny->setGodzinyCwiczeniowe(30);
        $godziny->setGodzinyWykladowe(30);
        $zajecia1->setGodziny($godziny);
        $zajecia1->setDokumentacjaEfektowUczenia(array('Zadania bieżące wykonywane podczas laboratorium (archiwum na Moodle).
Dwa sprawdziany praktyczne (kolokwia) podczas laboratorium (archiwum na Moodle),
Egzamin pisemny z ocenami'));
        $efektyUczenia = new EfektyUczenia();
        $efektyUczenia->setKompetencje('');
        $efektyUczenia->setWiedza('1 - Zna podstawowe zasady programowania obiektowego. Rozumie znaczenie programowania obiektowego dla tworzenia dużych systemów informatycznych

2 - Zna środowisko programistyczne wspierające pracę w wybranym obiektowym języku programowania, zna mechanizmy dziedziczenia i polimorfizmu, klasy abstrakcyjne oraz interfejsy

3 -  zna przydatność paradygmatu obiektowego do rozwiązywania różnego typu problemów
');
        $efektyUczenia->setUmiejetnosci('1 -  Ma umiejętność formułowania algorytmów i ich programowania z użyciem języka obiektowego

2 -  potrafi dokonać obiektowej analizy dziedziny i  zaprojektować strukturę klas dla danego zagadnienia i

3 - Potrafi ocenić przydatność środowiska programistycznego wspierającego pracę w wybranym obiektowym języku programowania. Potrafi wybrać i używać narzędzia do projektowania, implementowania, testowania i debugowania  programów obiektowych
');
        $zajecia1->setEfektyUczenia($efektyUczenia);
        $zajecia1->setOpis('');
        $zajecia1->setUwagi('Liczba punktów do zdobycia za bieżące ćwiczenia laboratoryjne: 30
Liczba punktów do zdobycia za sprawdziany praktyczne: 70
Liczba punktów do zdobycia za egzamin praktyczny pisemny: 100
Minimalna łączna liczba punktów konieczna do zaliczenia: 101
');
        $zajecia1->setZalozenia('');
        $zajecia1->setJezykWykladowy('polski');
        $zajecia1->setKryteriaOceniania('Ćwiczenia laboratoryjne (wejściówki, zadania rozwiązywane na laboratorium) – 15%, dwa sprawdziany praktyczne – 35%, egzamin – 50%.');
        $zajecia1->setZakresTematow('Tematyka wykładów:
•	Wprowadzenie do programowania obiektowego. Pojęcie klasy i obiektu. Składowe klasy - pola i metody. 
•	Ochrona danych, hermetyzacja, specyfikacja dostępu do pól i metod, słowo kluczowe this. 
•	Składowe statyczne. 
•	Tworzenie, inicjalizacja i niszczenie obiektów. 
•	Przeciążanie konstruktorów. Projektowanie klas. Obiektowe modelowanie dziedziny. Dziedziczenie. 
•	Dziedziczenie a zawieranie. 
•	Hierarchia klas, konstruktory a dziedziczenie. 
•	Funkcje wirtualne i polimorfizm. 
•	Klasy abstrakcyjne i interfejsy. Zastosowanie interfejsów. 
•	Wyjątki. Przestrzenie nazw. 
•	Przeciążanie operatorów, indeksatory, funkcje konwertujące. 
•	Strumienie, praca z plikami, serializacja. 
•	Kolekcje. 
•	Typy ogólne. 
•	Mechanizm refleksji..
Tematyka ćwiczeń laboratoryjnych: 
•	Informacje o środowisku Visual Studio i języku C#. Uwagi o Javie i środowisku NetBeans. 
•	Tworzenie klas. Hermetyzacja. 
•	Przykłady klas z .NET i ich zastosowania (Math, Convert, String, StringBuilder,  Tablice i klasa Array). 
•	Programowanie z wykorzystaniem dziedziczenia, funkcji wirtualnych oraz polimorfizmu. 
•	Programowanie z wykorzystaniem interfejsów. 
•	Programowanie z wykorzystaniem kolekcji. 
•	Programowanie z zastosowaniem typów ogólnych. 
•	Samodzielne tworzenie bibliotek obiektowych..');
        $zajecia1->setZalozeniaWstepne('');
        $zajecia1->setWymaganiaFormalne('Wstęp do Programowania, Matematyka Dyskretna. Konieczna podstawowa umiejętność programowania imperatywnego w językach strukturalnych oraz  umiejętność projektowania prostych struktur danych');
        $zajecia1->setMetodyDydaktyczne(array('Wykład', 'Dyskusja problemu', 'Studium przypadków', 'Pisanie programów', 'Prezentacja i analiza kodów źródłowych', 'Konsultacje'));

        $miejsceRealizacji = new MiejsceRealizacji();
        $miejsceRealizacji->setCwiczenia('Laboratorium komputerowe');
        $miejsceRealizacji->setWyklad('Sala audytoryjna');

        $zajecia1->setMiejsceRealizacji($miejsceRealizacji);
        $zajecia1->setWeryfikacjaEfektowUczenia(array('Zadania bieżące wykonywane podczas laboratorium.', 'Dwa sprawdziany praktyczne (kolokwia) podczas laboratorium',
            'Egzamin pisemny praktyczny z pytaniami i zadaniami podobnymi do zadań z kolokwiów obejmujących całość materiału'));
        $zajecia1->setStatusPodstawowe(true);
        $zajecia1->setStatusObowiazkowe(true);
        $zajecia1->setNazwaPolska('Programowanie obiektowe');
        $zajecia1->setNazwaAngielska('Object oriented programming');


        $zajecia2 = new Zajecia();
        $zajecia2->setCele('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
        $godziny2 = new Godziny();
//        $godziny->setCzasPracyWlasnej();
        $godziny2->setECTS(2);
        $godziny2->setGodzinyCwiczeniowe(0);
        $godziny2->setGodzinyWykladowe(30);
        $zajecia2->setGodziny($godziny2);
        $zajecia2->setDokumentacjaEfektowUczenia(array('Zaliczenie pisemne'));
        $efektyUczenia2 = new EfektyUczenia();
        $efektyUczenia2->setKompetencje('');
        $efektyUczenia2->setWiedza('');
        $efektyUczenia2->setUmiejetnosci('1 Wykazuje się umiejętnością logicznego myślenia i porządkowania informacji w postaci wiedzy ogólnej');
        $zajecia2->setEfektyUczenia($efektyUczenia2);
        $zajecia2->setOpis('');
        $zajecia2->setUwagi('');
        $zajecia2->setZalozenia('');
        $zajecia2->setJezykWykladowy('polski');
        $zajecia2->setKryteriaOceniania('Zaliczenie pisemne');
        $zajecia2->setZakresTematow('Tematyka wykładów:
Wiedza społeczna a socjologia: przedsocjologiczna wiedza o społeczeństwie, cechy naukowego podejścia do wiedzy społecznej, prekursorzy socjologii, perspektywa poznawcza socjologii (model pozytywistyczny i model humanistyczny).
Proces socjalizacji a społeczne funkcjonowanie jednostek: socjalizacja, jako rezultat wpływu środowiska, mechanizmy społecznego uczenia się, współzależność pomiędzy przebiegiem procesu socjalizacji a osobowością i pełnieniem ról społecznych. Problem tożsamości społecznej.
Kultura jako atrybut człowieka: treść kultury a proces socjalizacji (wzory sposobów myślenia reagowania i odczuwania, wartości, normy i sankcje), różnorodność kultur i kryteria wyodrębniania kultur, teorie internalizacji kultury, etnocentryzm i relatywizm kulturowy.
Nierówności społeczne: różnice indywidualne a nierówności społeczne, dobra generujące nierówności społeczne, idea stratyfikacji społecznej (hierarchie, kategorie i warstwy społeczne, uwarstwienie społeczne), ruchliwość społeczna (ruchliwość pionowa jednostkowa: awans i degradacja, ruchliwość zbiorowości i zmiana hierarchii), dychotomiczna struktura nierówności społecznych (teoria klasowa, dyskryminacja zawodowa kobiet, sytuacja mniejszości i większości narodowościowych i etnicznych), ideologie nierówności społecznych (elitarystyczna, egalitarna, merytokratyczna).
Specyfika władzy jako dobra generującego nierówności społeczne: pojęcie władzy, obecność władzy w nierównościach stratyfikacyjnych i dychotomicznych, warunki istnienia władzy, strategie zmierzające do zachowania i umocnienia władzy oraz do uwolnienia się spod wpływu władzy, odmiany władzy w relacjach pomiędzy grupami i jednostkami (dominacja, władza w kontaktach międzyludzkich, władza w ramach stosunków społecznych), władza a autorytet, formy legitymizacji władzy  realizacja przywództwa.
Świadomość społeczna: prywatne przeświadczenia oraz publiczna widoczność idei, proces kształtowania świadomości społecznej, świadomość społeczna w różnych zbiorowościach (świadomość globalna, narodowa, klasowa, religijna), odmiany świadomości społecznej (myślenie potoczne, sfera sacrum, sztuka, ideologie, opinia publiczna, wiedza naukowa), patologia świadomości społecznej (stereotypy, dystans społeczny, segregacja, dyskryminacja, eksterminacja).
Zagadnienia zmiany i rozwoju społecznego: zmiana społeczna, rozwój, postęp i regres, historyczna typologia społeczeństw, czynniki rozwoju społecznego (postęp techniczny, dyfuzja kultury, ruchy społeczne, wiktymizacja społeczeństwa polskiego po okresie transformacji ustrojowej jako przykład relatywizmu postępu społecznego.
Ponowoczesność i globalizacja: ambiwalencja skutków industrializmu, krytyka społeczeństwa nowoczesnego  i ponowoczesnego (alienacja, anomia, upadek wspólnot, zagrożenie środowiska naturalnego, nierówności globalne, krytyka wojny), wizje społeczeństwa ponowoczesnego, specyfika późnej nowoczesności i ponowoczesności Anthonego Giddensa, wyznaczniki globalizacji, prekursorzy teorii globalizacji ( teorie imperializmu, zależności, systemu światowego), trzy wymiary globalizacji, kulturowa uniformizacja - ekumeny wg Ulfa Hanerza, wizje świata przyszłości).
');
        $zajecia2->setZalozeniaWstepne('');
        $zajecia2->setWymaganiaFormalne('');
        $zajecia2->setMetodyDydaktyczne(array('Wykład', 'Konsultacje'));

        $miejsceRealizacji2 = new MiejsceRealizacji();
        $miejsceRealizacji2->setCwiczenia('');
        $miejsceRealizacji2->setWyklad('Sala audytoryjna');

        $zajecia2->setMiejsceRealizacji($miejsceRealizacji2);
        $zajecia2->setWeryfikacjaEfektowUczenia(array('Zaliczenie pisemne'));
        $zajecia2->setStatusPodstawowe(true);
        $zajecia2->setStatusObowiazkowe(false);
        $zajecia2->setNazwaPolska('Socjologia');
        $zajecia2->setNazwaAngielska('Socjology');

        $manager->persist($zajecia1);
        $manager->persist($zajecia2);

        $this->addReference('zajecia1', $zajecia1);
        $this->addReference('zajecia2', $zajecia2);
        $manager->flush();
    }
}
