<?php

namespace NP\Bundle\NewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class NewsGroupFormType extends AbstractType
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
                'publish' =>  $this->translator->trans('core.index.form_group.publish', array(), 'NPCoreBundle'),
                'delete' => $this->translator->trans('core.index.form_group.delete', array(), 'NPCoreBundle')
            ),
            'multiple'  => false,
            'attr' => array('class' => 'medium')
        ));
    }

    public function getName()
    {
        return 'np_news_group';
    }
}