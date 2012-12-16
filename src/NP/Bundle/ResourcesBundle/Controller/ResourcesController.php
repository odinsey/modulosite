<?php

namespace NP\Bundle\ResourcesBundle\Controller;

use NP\Bundle\CoreBundle\Controller\BaseAdminController;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ResourcesController extends BaseAdminController {

    protected $doctrine_namespace = "NPResourcesBundle:Resources";

    public function listAction() {
        $repository = $this->getDoctrine()->getRepository($this->doctrine_namespace);
        $request = $this->getRequest();
        $items = $repository->findAll();
        //$items = $repository->findPage($request->query->get('page'), $request->query->get('limit'));
        // the line above would work provided you have created "findPage" function in your repository
        // yes, here we are retrieving "_format" from routing. In our case it's json
        $format = $request->getRequestFormat();
        $datas = array();

        foreach ($items as $item) {
            $datas[] = array(
                'title' => $item->getTitle(),
                'description' => $item->getDescription(),
                'url' => $item->getUrl()
            );
        }


        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->serialize($datas, 'json');

        return $this->render('::base.' . $format . '.twig', array('data' => $json));
    }

}
