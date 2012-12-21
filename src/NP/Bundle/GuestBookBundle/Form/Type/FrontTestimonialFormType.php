<?php

namespace NP\Bundle\GuestBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FrontTestimonialFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('text');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'NP\Bundle\GuestBookBundle\Entity\Testimonial',
        );
    }
    
    public function getName()
    {
        return 'np_fronttestimonial';
    }
}
