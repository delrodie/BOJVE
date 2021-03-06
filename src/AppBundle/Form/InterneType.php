<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use AppBundle\Entity\DocInterne;
use AppBundle\Form\DocInterneType;

class InterneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off'
                  )
            ))
            ->add('datedeb', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off'
                  )
            ))
            ->add('resume', TextareaType::class, array(
                  'attr'  => array(
                      'class' => 'form-control'
                  ),
                  'required' => true
            ))
            //->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('statut')
            ->add('document', DocInterneType::class)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Interne'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_interne';
    }


}
