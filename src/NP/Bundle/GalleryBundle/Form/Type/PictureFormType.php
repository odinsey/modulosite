<?php

namespace NP\Bundle\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PictureFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
			->add('title', 'text', array('label' => 'Titre'))
			->add('url', 'image', array('required'=>false, 'mapped' => false))
			->add('file', 'file', array('label' => 'Photo'));
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){
		$resolver->setDefaults(array(
			'data_class' => 'NP\Bundle\GalleryBundle\Entity\Picture'
		));
	}

	public function getName(){
		return 'np_gallery_picture';
	}
}
