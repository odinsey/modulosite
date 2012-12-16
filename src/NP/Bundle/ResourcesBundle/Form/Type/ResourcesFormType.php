<?php

namespace NP\Bundle\ResourcesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResourcesFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('title', null, array('label' => 'Nom'))
			->add('description', 'richeditor', array('label' => 'Description'))
			->add('published', null, array('label' => 'Publié', 'required'=>false))
                        ->add('file');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){
		$resolver->setDefaults(array(
			'data_class' => 'NP\Bundle\ResourcesBundle\Entity\Resources',
			'cascade_validation' => true
		));
	}

	public function getName(){
		return 'np_resources_resources';
	}
}
