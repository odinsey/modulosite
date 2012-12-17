<?php

namespace NP\Bundle\GuestBookBundle\Form\Handler;

use Symfony\Component\Form\Form;
use NP\Bundle\CoreBundle\Form\Handler\BaseGroupFormHandler;

class TestimonialGroupFormHandler extends BaseGroupFormHandler {

    protected $repository_name = 'NPGalleryBundle:Gallery';

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

                if ($data->action == 'validate') {
                    $repository->validateGroup($ids_filtered);
                    return 'validate';
                }

                if ($data->action == 'refuse') {
                    $repository->refuseGroup($ids_filtered);
                    return 'refuse';
                }
            }
        }
        return false;
    }

}