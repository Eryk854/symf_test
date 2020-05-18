<?php

namespace App\Forms\Type;

use App\Entity\EfektyUczenia;
use App\Entity\Godziny;
use App\Entity\Literatura;
use App\Entity\Zajecia;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ZajeciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa_angielska', TextType::class, [
                'required'=>false,
                'attr'=>['class' => 'form-control']
            ])
            ->add('jezyk_wykladowy', ChoiceType::class, [
                'choices' => [
                    'polski' => 'polski',
                    'angielski' => 'angielski',
                ],
                'attr'=>['class'=>'form-control']
            ])
            ->add('godziny', HourType::class)
            ->add('zalozenia', TextareaType::class, [
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                'label'=>'Zalozenia przedmiotu'
                ])
            ->add('cele',  TextareaType::class, [
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                'label'=>'Cele przedmiotu'
            ])
            ->add('opis', TextareaType::class, [
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                'label'=>'Opis przedmiotu'
            ])
            ->add('zakres_tematow', TextareaType::class, [
                'attr'=>['class' => 'form-control','rows'=>4],
                'required'=>false,
                'label'=>'Podaj zakres tematów przedmiotu.'
            ])

            ->add('metody_dydaktyczne', ChoiceType::class, [
                'choices' => [
                    'dyskusja' => 'dyskusja',
                    'wyklad' => 'wyklad',
                    'rowiazywanie problemow' => 'rozwiazywanie problemow',
                    'konsultacje' => 'konsultacje',
                    'laboratoria' => 'laboratoria',
                    'tworzenie programow komputerowych' => 'tworzenie programow komputerowych',
                ],
                'multiple' => true,
                'attr'=>['class' => 'form-control form-control-sm']
            ])
            // wymagania formalne obiekt zajecia pobrany z bazy danych
//            ->add('wymagania_formalne', EntityType::class, [
//                'class'=>Zajecia::class,
//                'choice_label'=>'nazwaPolska',
//                'multiple'=>true,
//                'required'=>false
//            ])

            // założenia wstępne obiekt zajecia pobrany z bazy danych

            ->add('efekty_uczenia', EfektyUczeniaType::class)
            ->add('weryfikacja_efektow_uczenia', ChoiceType::class, [
                'choices' => [
                    'egzamin pisemny' => 'egzamin pisemny',
                    'egzamin ustny' => 'egzamin ustny',
                    'kolokwium' => 'kolokwium',
                    'zadania podczas zajec' => 'zadania podczas zajec',
                    'prezentacja' => 'prezentacja',
                ],
                'multiple' => true,
                'attr'=>['class' => 'form-control form-control-sm']
            ])

            ->add('dokumentacja_efektow_uczenia', ChoiceType::class, [
                'choices' => [
                    'praca pisemna' => 'praca pisemna',
                    'programy komputerowe' => 'programy komputerowe',
                    'prezentacja' => 'prezentacja',
                ],
                'multiple' => true,
                'attr'=>['class' => 'form-control form-control-sm']
            ])
            ->add('kryteria_oceniania', TextareaType::class, [
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                ])
            ->add('status_obowiazkowe', CheckboxType::class, [
                'label'    => 'Zajęcia obowiązkowe',
                'required' => false,
            ])
            ->add('status_podstawowe', CheckboxType::class, [
                'label'    => 'Zajęcia podstawowe',
                'required' => false,
            ])
            ->add('miejsce_realizacji', MiejsceRealizacjiType::class)
            # take data from db - literatura
            ->add('literatura', EntityType::class, [
                'class'=>Literatura::class,
                'choice_label'=>'tytul',
                'multiple'=>true,
                'required'=>false,
                'attr'=>['class' => 'form-control form-control-sm']
            ])
            ->add('uwagi', TextareaType::class, [
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],])
            ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zajecia::class,
        ]);
    }
}
