<?php
namespace App\Tests\Controller;

use App\Entity\Zajecia;
use App\Forms\Type\ZajeciaType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;
class SylabusControllerTest extends WebTestCase
{

    public function testShowEditFormSylabus()
    {
        //test użytkownik który jest koordynatorem ma dostęp do edycji
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        $client->request('GET', '/sylabus/form/29');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('html h2', 'Sieci Komputerowe');
        $this->assertSelectorTextContains('html h4', 'Stacjonarne');
        $this->assertSelectorTextContains('html h4', '1 stopień');
    }
    public function testShowEditFormRedirect()
    {
        //test użytkownik anonimowy przekierowany do logowania
        $client = static::createClient();
        $client->request('GET', '/sylabus/form/29');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
    public function testShowEditFormAccesDeied()
    {
        //użytkownik, który nie ma dstępu do tego sylabusa dostaje access denied
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager2',
            'PHP_AUTH_PW'   => 'manager2',
        ));
        $client->request('GET', '/sylabus/form/29');

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
    public function testConfirmSylabus()
    {
        // po zatwierdzeniu sylabusa powinniśmy zostać przekierowani na ścieżkę sylabus/{nr}
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        //$client->request('GET', '/sylabus/form/1');
        $crawler = $client->request('GET', '/sylabus/form/30');
        $form = $crawler->selectButton('sylabus[confirm]')->form();
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/sylabus/30'));

    }
    public function testSaveSylabus()
    {
        //testujemy zapisanie sylabusa powinniśmy pozostać na tej samej podstronie
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        //$client->request('GET', '/sylabus/form/1');
        $crawler = $client->request('GET', '/sylabus/form/29');
        $form = $crawler->selectButton('sylabus[save]')->form();
        $crawler = $client->submit($form);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('h2')->count());

    }
    public function testDisplayNewSylabusForm()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        $crawler = $client->request('GET', '/sylabus/new/2');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('html h3', '2018/2019');
        $this->assertSelectorTextContains('html h4', '1 stopień');
        $this->assertSelectorTextContains('html h4', 'Stacjonarne');
    }
    public function testRedirectionOfCreatingNewSylabus()
    {
        //funkcja testuje odpowiednie wyświetlanie się formularzy odpowiedzialnych za tworzenie/duplikowanie sylabusa
        //sprawdzamy czy formularze przekierowują na odpowiednią stronę oraz czy zawierają poprawne pola
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        $crawler = $client->request('POST', '/sylabus/new/2',['nazwa'=>'Analiza']);

        $crawler = $client->submitForm('nowy_sylabus[utworz]', ['nowy_sylabus[nazwa]' => 'Analiza']);
        $form_without = $crawler->selectButton('without_duplication')->form();
        $form_with = $crawler->selectButton('with_duplication')->eq(0)->form();

        $this->assertEquals($client->request('GET','/sylabus/make/')->getUri(),$form_without->getUri());
        $this->assertEquals('POST', $form_without->getMethod());

        $this->assertEquals($client->request('GET','/sylabus/make/')->getUri(),$form_with->getUri());
        $this->assertEquals('POST', $form_with->getMethod());

        $this->assertEquals(array_keys($form_without->getValues()),['without_duplication','nazwa','program_id']);
        $this->assertEquals(array_keys($form_with->getValues()),['with_duplication','przedmiot_id','program_id']);

    }
    public function testDisplayNewSylabusFormWithSuggested()
    {
        //testujemy wyświetlanie formularza po wpisaniu prawdziwej wartości sugestii
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        $client->request('GET', '/sylabus/new/2');
        $crawler = $client->submitForm('nowy_sylabus[utworz]', ['nowy_sylabus[nazwa]' => 'Analiza']);
        $crawler_not = $client->submitForm('nowy_sylabus[utworz]', ['nowy_sylabus[nazwa]' => 'wfefwe']);



        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Utwórz sylabus o tej nazwie bez duplikacji żadnych danych',$crawler->selectButton('without_duplication')->text());
        $this->assertGreaterThan(6, $crawler->filter('button')->count());
        $this->assertEquals(3, $crawler_not->filter('button')->count());
    }
    public function testDuplication()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));
        $client->request('POST', '/sylabus/make/',['program_id'=>2,'przedmiot_id'=>'3']);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler=$client->followRedirect();
        $form = $crawler->selectButton('sylabus[save]')->form();
        $godziny = $form->get('sylabus[zajecia][godziny][godziny_wykladowe]')->getValue();
        $kryteria = $form->get('sylabus[zajecia][kryteria_oceniania]')->getValue();
        // Sprawdzamy czy sylabus skopiował się poprawnie
        $this->assertStringContainsString('Podstawy fizyki',$crawler->filter('h2')->eq(0)->text());
        $this->assertEquals('30',$godziny);
        $this->assertEquals('Ćwiczenia i kolokwium pisemne 40%, egzamin pisemny 60%.',$kryteria);

        //Sprawdzamy czy wartości niezbędne do wyświetlenia podglądu sylabusa zostały poprawnie zapisane
        $nr = substr($crawler->getUri(),-3);
        $client->request('GET', '/sylabus/'.$nr);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testNewWithoutDuplication()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'manager1',
            'PHP_AUTH_PW'   => 'manager1',
        ));

        $client->request('POST', '/sylabus/make/',['program_id'=>2, 'nazwa'=>'Programowanie komponentowe']);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $crawler=$client->followRedirect();
        $form = $crawler->selectButton('sylabus[save]')->form();
        $godziny_wyk = $form->get('sylabus[zajecia][godziny][godziny_wykladowe]')->getValue();
        $godziny_proj = $form->get('sylabus[zajecia][godziny][godziny_projektowe]')->getValue();
        $kryteria = $form->get('sylabus[zajecia][kryteria_oceniania]')->getValue();

        // Testujemy czy wyświetlił się odpowiedni formularz do edycji nowego sylabusa
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Programowanie komponentowe',$crawler->filter('h2')->eq(0)->text());
        $this->assertEquals('0',$godziny_wyk);
        $this->assertEquals('',$kryteria);

        //Testujemy czy wartości inicjalizujące zostały dobrze ustawione i czy podgląd sylabusa poprawnie się wyświetla
        $nr = substr($crawler->getUri(),-3);
        $client->request('GET', '/sylabus/'.$nr);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
