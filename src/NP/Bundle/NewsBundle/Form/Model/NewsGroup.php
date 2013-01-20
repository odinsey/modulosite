<?php
namespace NP\Bundle\NewsBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class NewsGroup {
    /**
     * @Assert\Choice(callback = "getActions")
     */
    public $action;

    public static function getActions()
    {
        return array(
            'none',
            'publish',
            'unpublish',
            'delete'
        );
    }
}