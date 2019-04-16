<?php

namespace App\Form;

use App\Entity\Flights;
use App\Entity\Arrivals;
use App\Entity\Departures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FlightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flightName')
            ->add('flightNumber')
            ->add('departures', EntityType::class,[
                'class' => Departures::class,
                'choice_label' => 'ville_de_depart',
            ])
            ->add('Arrivals', EntityType::class,[
                'class' => Arrivals::class,
                'choice_label' => 'villed_Ariver',
            ])
            ->add('date')
            //->add('createdAt')
            ->add('maxPlace')
            ->add('imageFile', FileType::class)
           
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flights::class,
            'translation_domain' => 'forms'
        ]);
    }
}
