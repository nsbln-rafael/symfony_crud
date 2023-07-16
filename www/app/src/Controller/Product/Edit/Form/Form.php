<?php

namespace App\Controller\Product\Edit\Form;

use App\Controller\Product\Edit\Dto\ProductEditData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'constraints' => [
                        new Length([
                            'max'        => 255,
                            'maxMessage' => 'Значение слишком длинное. Название должно быть меньше' . ' {{ limit }}'
                        ]),
                        new NotBlank([
                            'message' => 'Необходимо заполнить название',
                        ]),
                    ],
                ]
            )
            ->add(
                'price',
                NumberType::class,
                [
                    'constraints' => [
                        new PositiveOrZero([
                            'message' => 'Значение должно быть положительным числом',
                        ]),
                        new NotBlank([
                            'message' => 'Необходимо указать себестоимость',
                        ]),
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductEditData::class,
        ]);
    }
}