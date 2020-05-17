<?php

namespace App\Forms\Type;

use App\Entity\EfektyUczenia;
use App\Entity\Godziny;
use App\Entity\Literatura;
use App\Entity\MiejsceRealizacji;
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
use function Sodium\add;

class MiejsceRealizacjiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wyklad', ChoiceType::class,[
                'choices' => [
                    'aula' => 'aula',
                    'sala audytoryjna' => 'sala audytoryjna',
                    'sala z tablica' => 'sala z tablica',
                ],
                'multiple' => false,
                'attr'=>['class' => 'form-control form-control-sm']
            ])
            ->add('cwiczenia', ChoiceType::class,[
                'choices' => [
                    'aula' => 'aula',
                    'sala audytoryjna' => 'sala audytoryjna',
                    'sala z tablica' => 'sala z tablica',
                    'laboratorium komputerowe' => 'laboratorium komputerowe',
                ],
                'multiple' => false,
                'attr'=>['class' => 'form-control form-control-sm']
            ])
//        ->add('wyklad', TextType::class)
//        ->add('cwiczenia', TextType::class)

        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MiejsceRealizacji::class,
        ]);
    }
}
