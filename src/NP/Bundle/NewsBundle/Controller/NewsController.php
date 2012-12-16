<?php

namespace NP\Bundle\NewsBundle\Controller;

use NP\Bundle\CoreBundle\Controller\BaseAdminController;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class NewsController extends BaseAdminController
{
    protected $doctrine_namespace = "NPNewsBundle:News";
    protected $template_new = 'NPGalleryBundle:CRUD:new.html.twig';
    protected $template_edit = 'NPGalleryBundle:CRUD:edit.html.twig';

        public function listAction() {
        $repository = $this->getDoctrine()->getRepository($this->doctrine_namespace);
        $request = $this->getRequest();
        $items = $repository->findAll();
        //$items = $repository->findPage($request->query->get('page'), $request->query->get('limit'));
        // the line above would work provided you have created "findPage" function in your repository
        // yes, here we are retrieving "_format" from routing. In our case it's json
        $format = $request->getRequestFormat();
        $datas = array();

        foreach( $items as $item ) {
            $pictures = array();
            foreach( $item->getPictures() as $picture ){
                $pictures[] = array(
                    'title' => $picture->getTitle(),
                    'img-medium' => $picture->getUrl('medium'),
                    'img-full'   => $picture->getUrl('big')
                );
            }
            $datas[] = array(
                'title'=> $item->getTitle(),
                'description' => $item->getDescription(),
                'pictures' => $pictures
            );
        }


        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->serialize($datas, 'json');

        return $this->render('::base.'.$format.'.twig', array('data' => $json));
    }
}
