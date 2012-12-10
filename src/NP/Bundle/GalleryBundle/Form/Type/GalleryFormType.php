<?php

namespace NP\Bundle\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('title', null, array('label' => 'Nom'))
			->add('description', null, array('label' => 'Description'))
			->add('pictures', 'picture_collection', array(
				'type' => new PictureFormType(),
				'allow_add' => true,
				'allow_delete' => false,
				'by_reference' => false,
				'attr' => array('class' => 'entity-collections sortable'),
				//label for each team form type
				'options' => array(
					'attr' => array('class' => 'entity-collection')
				))
		);
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){
		$resolver->setDefaults(array(
			'data_class' => 'NP\Bundle\GalleryBundle\Entity\Gallery',
			'cascade_validation' => true
		));
	}

	public function getName(){
		return 'np_gallery_gallery';
	}
}
