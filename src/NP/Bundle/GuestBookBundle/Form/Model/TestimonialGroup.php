<?php
namespace NP\Bundle\GuestBookBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use NP\Bundle\GuestBookBundle\Enum\StatusEnum;

class TestimonialGroup {
    /**
     * @Assert\Choice(callback = "getActions")
     */
    public $action;
    
    public static function getActions()
    {
        return StatusEnum::getValues();
    }
}
