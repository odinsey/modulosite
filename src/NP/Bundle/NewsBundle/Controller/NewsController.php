<?php

namespace NP\Bundle\NewsBundle\Controller;

use NP\Bundle\CoreBundle\Controller\BaseAdminController;

class NewsController extends BaseAdminController
{
    protected $doctrine_namespace = "NPNewsBundle:News";
    protected $template_new = 'NPGalleryBundle:CRUD:new.html.twig';
    protected $template_edit = 'NPGalleryBundle:CRUD:edit.html.twig';
}
