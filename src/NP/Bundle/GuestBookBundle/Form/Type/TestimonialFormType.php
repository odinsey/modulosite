<?php

namespace NP\Bundle\GuestBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use NP\Bundle\GuestBookBundle\Enum\StatusEnum;

class TestimonialFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $choices = array(''=>'');
        foreach (StatusEnum::getValues() as $action) {
            $choices[$action] = 'testimonial.form.status.'.$action;
        }
        
        $builder->add('name')
                ->add('text')
                ->add('status', 'choice', array(
                    'choices' => $choices
                ));
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'NP\Bundle\GuestBookBundle\Entity\Testimonial',
            'translation_domain' => 'NPGuestBookBundle'
        );
    }

    public function getName() {
        return 'np_testimonial';
    }

}
