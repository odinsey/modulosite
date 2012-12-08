<?php

namespace NP\Bundle\CoreBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

abstract class BaseGroupFormHandler {

    protected $repository_name = 'NPCoreBundle:Foo';
    protected $request;
    protected $em;
    protected $request_method = 'POST';

    public function __construct(Request $request, EntityManager $em) {
	$this->request = $request;
	$this->em = $em;
    }

    public function process(Form $form, $ids) {
	if ($this->request_method == $this->request->getMethod()) {
	    $form->bindRequest($this->request);

	    if (!is_array($ids) || count($ids) <= 0)
		return false;

	    if ($form->isValid()) {
		$data = $form->getData();

		$ids_filtered = array();
		foreach ($ids as $id) {
		    $test = (int) $id;
		    if (is_int($test))
			array_push($ids_filtered, $test);
		}

		$repository = $this->em->getRepository($this->repository_name);
		if ($data->action == 'delete') {
		    $repository->deleteGroup($ids_filtered);
		    return 'delete';
		}
	    }
	}
	return false;
    }

}