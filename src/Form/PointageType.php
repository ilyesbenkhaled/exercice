<?php

namespace App\Form;

use App\Entity\Pointage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date')
            ->add('Duree', TimeType::class, [
              'input'  => 'datetime',
              'widget' => 'choice',
            ])
            ->add('Matricule_utilisateur')
            ->add('Chantier_pointage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class,
        ]);
    }
}
