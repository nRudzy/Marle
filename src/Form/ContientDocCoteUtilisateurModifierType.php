<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContientDocCoteUtilisateurModifierType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refDocument', TextType::class, [
                'label' => 'Référence du document'
            ])
            ->add('indice', TextType::class,[
                'label' => 'Indice',
                'attr' => [
                    'placeholder' => '000',
                    'maxlength' => '3',
                    'size' => '3',

                ],
            ])
            ->add('typeDocument', ChoiceType::class,[
                'label' => 'Type du document',
                'choices' => [
                    'Divers' => 'Divers',
                    'DRT' => 'DRT',
                    'DSE/Plan' => 'DSE/Plan',
                    'Besoin du service' => 'Besoin du service',
                    'Astreinte' => 'Astreinte',
                    'APE' => 'APE'
                ],
            ])
            ->add('tampon', ChoiceType::class, [
                'label' => 'Tampon',
                'choices' => [
                    'MAJ' => 'MAJ',
                    'Délivré le' => 'Délivré le',
                    'Nouveau' => 'Nouveau',
                    'Réappro' => 'Réappro',
                ],

            ])
            ->add('couleur', CheckboxType::class,[
                'label' => 'Plastifié',
                'required' => false,
            ])
            ->add('nbExemplaireA3', IntegerType::class, [
                'label' => 'Nombre A3',
                'attr' => [
                    'min' => '0',
                    'value' => '0',
                ],
            ])
            ->add('nbExemplaireA4', IntegerType::class, [
                'label' => 'Nombre A4',
                'attr' => [
                    'min' => '0',
                    'value' => '0',

                ],
            ])
            ->add('nbExemplaireA5', IntegerType::class, [
                'label' => 'Nombre A5',
                'attr' => [
                    'min' => '0',
                    'value' => '0',
                ],
            ])
            ->add('nbExemplaireA0', IntegerType::class, [
                'label' => 'Nombre A0',
                'attr' => [
                    'min' => '0',
                    'value' => '0',
                ],
            ])
            ->add('rectoVerso', ChoiceType::class, [
                'choices' => [
                    'Recto' => 'Recto',
                    'Recto-Verso' => 'Recto-Verso'
                ],
                'label' => ' ',
            ])
            ->add('support', ChoiceType::class, [
                'label' => 'Support d\'impression',
                'choices' => [
                    'Papier blanc' => 'Papier blanc',
                    'Papier autre' => 'Papier autre',
                    'Carton blanc' => 'Carton blanc',
                    'Carton autre' => 'Carton autre',
                    'PDF' => 'PDF'
                ],
            ])
            ->add('nbTrous', ChoiceType::class, [
                'choices' => [
                    'Aucun' => 'Aucun',
                    '2 trous' => '2',
                    '4 trous' => '4',
                    'Gros trous' => 'Gros',

                ],
                'label' => 'Nombre de trous',
            ])
            ->add('reliement', ChoiceType::class, [
                'label' => 'Relié',
                'choices' => [
                    'Aucun' => 'Aucun',
                    'Thermoreliure' => 'Thermoreliure',
                    'Spirale' => 'Spirale',
                    'Attache' => 'Attache'
                ]
            ])
            ->add('agrafes', ChoiceType::class, [
                'label' => 'Nombre d\'agrafes',
                'choices' => [
                    'Aucun' => 'Aucun',
                    '1 point' => 1,
                    '2 points' => 2,
                ]
            ])
            ->add('pliure', CheckboxType::class,[
                'label' => 'Plié',
                'required' => false,
            ])
            ->add('massicotage', CheckboxType::class,[
                'label' => 'Massicoté',
                'required' => false,
            ])
            ->add('plastification', CheckboxType::class,[
                'label' => 'Plastifié',
                'required' => false,
            ]);

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\ContientDoc'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_contientdoc';
    }
}
