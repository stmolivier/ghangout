<?php

namespace CPASimUSante\GhangoutBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class HangoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            'text',
            array(
                'required' => true,
                'label' => 'name',
                'constraints' => new Assert\NotBlank()
            )
            )
            ->add('url', 'text',
            array(
                'required' => true,
                'constraints' => new Assert\NotBlank(),
                'attr' => [
                    'placeholder' => 'https://plus.google.com/hangouts/_/hangouthash'
                ]
            )
            )
            //->add('resourceNode')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CPASimUSante\GhangoutBundle\Entity\Hangout',
            'translation_domain' => 'resource'  //where are st the translations for this form
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cpasimusante_ghangoutbundle_hangout';
    }
}
