<?php

namespace NP\Bundle\GuestBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TestimonialGroupFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('action', 'choice', array(
            'choices'   => array(
                'none'   => '',
                'delete' => 'testimonial.index.form_group.delete',
                'validate' => 'testimonial.index.form_group.validate',
                'refuse' => 'testimonial.index.form_group.refuse'
            ),
            'multiple'  => false,
            'attr' => array('class' => 'medium')
        ));
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'translation_domain' => 'NPGuestBookBundle'
        );
    }
    
    public function getName() {
        return 'np_testimonial_group';
    }
}