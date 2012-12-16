<?php
namespace NP\Bundle\ResourcesBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ResourcesGroup {
    /**
     * @Assert\Choice(callback = "getActions")
     */
    public $action;

    public static function getActions()
    {
        return array(
            'none',
            'published',
            'delete'
        );
    }
}