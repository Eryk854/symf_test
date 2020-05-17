<?php

namespace App\Forms\Type;

use App\Entity\Godziny;
use App\Entity\Instytucja;
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

class SylabusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('jednostka_realizujaca', EntityType::class, [
                'class'=>Instytucja::class,
                'choice_label'=>'pelna_nazwa',
                'multiple'=>false,
                'required'=>false,
                'attr'=>['class'=>'form-control']
            ])
            ->add('jednostka_zlecajaca', EntityType::class, [
                'class'=>Instytucja::class,
                'choice_label'=>'pelna_nazwa',
                'multiple'=>false,
                'required'=>false,
                'attr'=>['class'=>'form-control']
            ])
            ->add('numer_katalogowy', TextType::class,[
                'label'=>'Numer katalogowy sylabusa',
                'attr'=>['class'=>'form-control'],
                'required'=>false
            ])
            ->add('zajecia', ZajeciaType::class)
            ->add('save', SubmitType::class,[
                'attr'=>['class'=>'btn btn-primary']
            ])
        ;

    }
}
