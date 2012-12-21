<?php

namespace NP\Bundle\GuestBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TestimonialGroupFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $choices = array(''=>'');
        foreach ($options['data']->getActions() as $action) {
            $choices[$action] = 'testimonial.index.form_group.'.$action;
        }
        $builder->add('action', 'choice', array(
            'choices'   => $choices,
            'multiple'  => false,
            'attr' => array('class' => 'medium')
        ));
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'NP\Bundle\GuestBookBundle\Form\Model\TestimonialGroup',
            'translation_domain' => 'NPGuestBookBundle'
        );
    }
    
    public function getName() {
        return 'np_testimonial_group';
    }
}