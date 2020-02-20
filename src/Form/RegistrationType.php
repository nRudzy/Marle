<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nni',TextType::class,[
                'attr' => [
                    'placeholder' => 'NNI',
                    'class' => 'form-control',
                ],
            ])
            ->add('password',PasswordType::class,[
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control',
                ],
            ])
            ->add('confirmPassword',PasswordType::class,[
                'attr' => [
                    'placeholder' => 'Répéter mot de passe',
                    'class' => 'form-control',
                ],
            ])
            ->add('nom',TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control',
                ],
            ])
            ->add('prenom',TextType::class,[
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-control',
                ],
            ])
            ->add('inscription', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary pull-right',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
