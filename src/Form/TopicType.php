<?php

namespace App\Form;

use App\Entity\Topic;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_topic',TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Введите заголовок топика.'
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Заголовок должен содержать минимум {{ limit }} символа',
                            // max length allowed by Symfony for security reasons
                            'max' => 100,
                            'maxMessage' => 'Заголовок должен содержать до {{ limit }} символов',
                        ])
                    ],
                    'attr' => [
                        'class' => 'input__text'
                    ]
                ])
            ->add('text_topic', TextareaType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите текст топика.'
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Текст топика содержать минимум {{ limit }} символов',
                        // max length allowed by Symfony for security reasons
                        'max' => 1000,

                        'maxMessage' => 'Текст топика должен содержать до {{ limit }} символов',
                    ])
                ],

                'attr' => [

                    'class' => 'input__text',

                    'rows' => "10"

                ]

            ])

        ->add('section_topic',ChoiceType::class,array(
        'choices'  => array(
            'Компьютеры' => 'Компьютеры',
            'Бытовая техника' => 'Бытовая техника',
            'Мобильные гаджеты' => 'Мобильные гаджеты',
            'Автомобильные гаджеты' => 'Автомобильные гаджеты',
            'Бытовая химия' => 'Бытовая химияч  ',
        )), [

        'required' => true,

        'constraints' => [

            new NotBlank([

                'message' => 'Выберите раздел топика.'

            ]),
        ],

        'attr' => [

            'class' => 'input__text'

        ]

    ]);
            /*->add('section_topic',TextType::class, [

              'required' => true,

              'constraints' => [

                  new NotBlank([

                      'message' => 'Выберите раздел топика.'

                  ]),
                                ],

              'attr' => [

                  'class' => 'input__text'

              ]

          ]);*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
        ]);
    }
}
