<?php

namespace NP\Bundle\GuestBookBundle\Controller;

use NP\Bundle\CoreBundle\Controller\BaseAdminController;

class TestimonialController extends BaseAdminController {

    protected $doctrine_namespace = "NPGuestBookBundle:Testimonial";
    protected $template_index = 'NPGuestBookBundle:Testimonial:index.html.twig';

}
