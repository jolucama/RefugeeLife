<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefugeeStoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('story')
            ->add('protagonist')
            ->add('protagonistEmail')
            ->add('protagonistPhone')
            ->add('comingFromCountry')
            ->add('refugeeInCountry')
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class)
            ->add('isDeathStory')
            ->add('goal')
            ->add('achievedGoalPercentage')
            ->add('isGoalAchieved')
            ->add('categories')        
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\RefugeeStory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_refugeestory';
    }


}
