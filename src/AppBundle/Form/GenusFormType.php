<?php

namespace AppBundle\Form;

use AppBundle\AppBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   $builder->add( 'name' )
                ->add( 'speciesCount' )
                ->add( 'funFact' );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
$resolver->setDefaults(['data_class'=>'AppBundle\Entity\Genus']);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_genus_form_type';
    }
}
