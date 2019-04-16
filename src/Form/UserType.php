<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname' )
            ->add('email', EmailType::class)
            // ->add('plainPassword', RepeatedType::class, array(
            //         'type' => PasswordType::class,
            //         'first_options' => array('label' => 'Mot de passe'),
            //         'second_options' => array('label' => 'Confirmation du mot de passe'),
            //     ))
            ->add('password', PasswordType::class)
            ->add('confirmPassword', PasswordType::class)
            ->add('gender', ChoiceType::class,[
                'label' => false,
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame',
                ], 'expanded' => true,
            ])
            ->add('address', TextareaType::class)
            ->add('city', TextType::class)
            ->add('postalCode', NumberType::class)
            ->add('phoneNumber', NumberType::class)
            // ->add('status', ChoiceType::class,[
            //     'choices' =>[
            //         'Passenger' => 'passenger',
            //         'Pilote' => 'pilote',
            //     ], 'expanded'=> true,
            // ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'forms'
        ]);
    }
}
