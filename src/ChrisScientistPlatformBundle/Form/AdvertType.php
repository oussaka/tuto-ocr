<?php

namespace ChrisScientistPlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('date', 'date')
            ->add('author', 'text')
            ->add('content', 'textarea')
            ->add('published', 'checkbox', array('required' => false))
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ChrisScientistPlatformBundle\Entity\Advert'
        ));
    }
    
    public function getName()
    {
        return 'chris_scientist_platformbundle_advert' ;
    }
}
