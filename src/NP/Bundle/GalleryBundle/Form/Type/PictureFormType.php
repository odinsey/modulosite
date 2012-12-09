<?php

namespace NP\Bundle\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PictureFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
	$builder
	    ->add('title', 'text', array('label' => 'Titre'))
	    ->add('file', 'file', array('required' => false, 'label' => 'Photo'))
		->add('position','hidden');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
	$resolver->setDefaults(array(
	    'data_class' => 'NP\Bundle\GalleryBundle\Entity\Picture'
	));
    }

    public function getName() {
	return 'np_gallery_picture';
    }

}
