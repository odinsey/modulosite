<?php

namespace NP\Bundle\GuestBookBundle\Form\Handler;

use Symfony\Component\Form\Form;
use NP\Bundle\CoreBundle\Form\Handler\BaseGroupFormHandler;

class TestimonialGroupFormHandler extends BaseGroupFormHandler {
    protected $repository_name = 'NPGuestBookBundle:Testimonial';
}