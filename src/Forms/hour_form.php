<?php

namespace App\Forms\Type;

use App\Entity\Godziny;
use App\Entity\Literatura;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
class HourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //Make godziny object
            ->add('godziny_wykladowe', NumberType::class, [
                'required'=>false,
                'attr'=>['type'=>'number', 'class' => 'form-control']
            ])
            ->add('godziny_cwiczeniowe', NumberType::class, [
                'required'=>false,
                'attr'=>['type'=>'number', 'class' => 'form-control']
            ])
            ->add('czas_pracy_wlasnej', NumberType::class, [
                'required'=>false,
                'attr'=>['type'=>'number', 'class' => 'form-control']])
            ->add('ECTS', NumberType::class, [
                'required'=>false,
                'attr'=>['type'=>'number', 'class' => 'form-control']
            ])
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Godziny::class,
        ]);
    }
}
