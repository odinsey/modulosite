<?php

namespace NP\Bundle\ResourcesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class ResourcesGroupFormType extends AbstractType
{
    protected $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('action', 'choice', array(
            'choices'   => array(
                'none'   => '',
                'publish' =>  $this->translator->trans('global.form_action.group.publish', array(), 'NPCoreBundle'),
                'unpublish' =>  $this->translator->trans('global.form_action.group.unpublish', array(), 'NPCoreBundle'),
                'delete' => $this->translator->trans('global.form_action.group.delete', array(), 'NPCoreBundle')
            ),
            'multiple'  => false,
            'attr' => array('class' => 'medium')
        ));
    }

    public function getName()
    {
        return 'np_resources_group';
    }
}