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
            ->add('image', new ImageType(), array('required' => false))
            ->add('categories', 'entity', 
                    array(
                        'class' => 'ChrisScientistPlatformBundle:Category', // peut être remplacer par le namespace
                        'property' => 'name',
                        'multiple' => true,
                        'expanded' => false
                        )
                    )
            ->add('save', 'submit')
        ;
        
        $builder->addEventListener(\Symfony\Component\Form\FormEvents::PRE_SET_DATA, 
                function (\Symfony\Component\Form\FormEvent $event)
                {
                    $advert = $event->getData() ;
                    if(is_null($advert))
                    {
                        return ;
                    }
                    
                    if( !($advert->getPublished()) || is_null($advert->getId()) )
                    {
                        $event->getForm()->add('published', 'checkbox', array('required' => false)) ;
                    }
                    else
                    {
                        $event->getForm()->remove('published') ;
                    }
                }) ;
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
