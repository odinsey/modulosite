<?php
namespace NP\Bundle\GalleryBundle\Controller;

use NP\Bundle\CoreBundle\Controller\BaseAdminController;

/**
 * Description of GalleryControler
 *
 * @author nicolas
 */
class GalleryController extends BaseAdminController {
    protected $doctrine_namespace = "NPGalleryBundle:Gallery";
    protected $template_new = 'NPGalleryBundle:CRUD:new.html.twig';
    protected $template_edit = 'NPGalleryBundle:CRUD:edit.html.twig';
}

?>
