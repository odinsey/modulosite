<?php
namespace NP\Bundle\GalleryBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class GalleryGroup {
    /**
     * @Assert\Choice(callback = "getActions")
     */
    public $action;
    
    public static function getActions()
    {
        return array(
            'none',
            'delete'
        );
    }
}