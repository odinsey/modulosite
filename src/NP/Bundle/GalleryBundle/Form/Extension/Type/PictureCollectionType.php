<?php

namespace NP\Bundle\GalleryBundle\Form\Extension\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class PictureCollectionType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options) {
    }

    public function getParent() {
	return 'collection';
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
	return 'picture_collection';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options) {
	return array();
    }

}