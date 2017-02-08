<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ImgPhotothequeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          //->add('photo')
          //->add('url')
          //->add('alt')
          ->add('description', TextareaType::class, array(
                'attr'  => array(
                    'class' => 'form-control'
                ),
                'required' => 'true'
          ))
          ->add('file', FileType::class, array(
              'label' => "Telecharger la photo",
              'required' => false,
          ))
          ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ImgPhototheque'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_imgphototheque';
    }


}
