<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchInputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('palabra', TextType::class, [
                'label'=>'Escribe una palabra...',
                'required'    => true,
            ])
            ->add('limite', ChoiceType::class, [
                'choices'=>[
                    '1'=>'1',
                    '5'=>'5',
                    '10'=>'10',
                    '15'=>'15',
                    '50'=>'50'
                ],
                'data'=>'5'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
