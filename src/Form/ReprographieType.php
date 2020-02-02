<?php

namespace App\Form;

use App\Entity\Taxonomie;
use App\Repository\TaxonomieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReprographieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de la demande',

            ])
            ->add('momentJournee', ChoiceType::class, [
                'choices' => [
                    'Matin' => 'M',
                    'Après-midi' => 'AM'
                ],
                'label' => 'Moment de la journée',
            ])
            ->add('estUrgence', CheckboxType::class, [
                'label' => 'Urgence ?',
                'required' => false,
            ])
            ->add('serviceDemandeur', EntityType::class, [
                'class' => Taxonomie::class,
                'query_builder' => function (TaxonomieRepository $tr) {
                    return $tr->createQueryBuilder('t')
                        ->where('t.codeTaxonomie = :codeServices')
                        ->setParameter('codeServices' , 'SRVC')
                        ->orderBy('t.libelle', 'ASC');
                },
                'choice_label' => 'libelle',
            ])
            ->add('lieuReception', ChoiceType::class, [
                'choices' => [
                    'Accueil DOC' => 'Accueil DOC',
                    'PILOTIMMO/Courrier interne' => 'Courrier',
                    'Réseau informatique' => 'Réseau informatique',
                ],
                'label' => 'Lieu de réception',
            ])
            ->add('observations', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Ajouter un renseignement, une observation, une indication...',
                    'rows' => '5'
                ],
                'label' => false,
                'required' => false,
            ])
            ->add('filigrane', ChoiceType::class, [
                'label' => 'Filigrane',
                'choices' => [
                    'Aucun' => 'Aucun',
                    'Crise réelle' => 'Crise réelle',
                    'Exercice' => 'Exercice',
                ]
            ]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Reprographie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_reprographie';
    }


}
