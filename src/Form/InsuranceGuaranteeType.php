<?php

namespace App\Form;

use App\Entity\InsuranceGuarantee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsuranceGuaranteeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('coverage')
            ->add('monthlyPrice')
            ->add('pack')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InsuranceGuarantee::class,
        ]);
    }
}
