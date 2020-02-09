<?php

namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserMailType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creator', EntityType::class, array(
                'class' => 'UserBundle\Entity\User',
                'attr' => [
                    'readonly' => true
                ]
            ))
            ->add('sendTo',TextType::class,  array('attr' =>['placeholder'=>'Send To *']))
            ->add('message',TextareaType::class,  array('attr' =>['placeholder'=>'Your Message *']))
        ;

        $builder
            ->add('submit', SubmitType::class,
                ['label' => 'Send Message'])
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\UserMail'
        ));
    }

}
