<?php

namespace App\Form;

use App\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, 
                [
                    'label' => 'Название',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('doi', TextType::class, 
                [
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('year', DateType::class, 
                [
                    'label' => 'Год',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('pages', NumberType::class, 
                [
                    'label' => 'Страницы',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('first_name', TextType::class, 
                [
                    'label' => 'Инициалы',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('second_name', TextType::class, 
                [
                    'label' => 'Фамилия',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('type', TextType::class, 
                [
                    'label' => 'Тип публикации',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('city', TextType::class, 
                [
                    'label' => 'Город',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('publisher', TextType::class, 
                [
                    'label' => 'Издательство',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ])
            ->add('save', SubmitType::class, [
                'label' => 'Добавить публикацию',
                'attr' => [
                    'class' => 'btn btn-primary g-3',
                ],
            ])
        ;
    }
/*
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
    */
}
