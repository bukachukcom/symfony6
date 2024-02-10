<?php

namespace App\Form;

use App\Filter\BlogFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('title', TextType::class, ['required' => false])
            ->add('content', TextType::class, ['required' => false, 'mapped' => false])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (PreSubmitEvent $event): void {
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogFilter::class,
            'csrf_protection' => false,
        ]);
    }
}
