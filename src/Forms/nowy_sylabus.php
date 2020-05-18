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
class NowySylabusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //Make godziny object
            ->add('nazwa', TextType::class, [
                'label'=>'Podaj nazwę przedmiotu dla którego chcesz utworzyć sylabus: '
            ])
            ->add('utworz', SubmitType::class,[
                'attr'=>['class'=>'btn btn-primary'],
                'label'=>'Wyszukaj istniejące sylabusy o tej podobnej nazwie'
            ])
        ;

    }

}
