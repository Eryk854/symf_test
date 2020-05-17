<?php

namespace App\Forms\Type;

use App\Entity\EfektyUczenia;
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
class EfektyUczeniaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //Make efekty uczenia object
            ->add('wiedza', TextareaType::class,[
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                'label'=>'Wiedza, która zostanie przekazana podczas kursu'
                ])
            ->add('umiejetnosci', TextareaType::class,[
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                'label'=>'Umiejętności, które uczestnik nabędzie po zakończeniu przedmiotu'
            ])
            ->add('kompetencje', TextareaType::class,[
                'required'=>false,
                'attr'=>['class' => 'form-control','rows'=>4],
                'label'=>'Kompetencje jakie uczestnik zdobędzie po ukończeniu przedmiotu'
            ])
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EfektyUczenia::class,
        ]);
    }
}
