<?php

namespace NP\Bundle\GuestBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NP\Bundle\GuestBookBundle\Entity\Testimonial;
use NP\Bundle\GuestBookBundle\Form\Type\FrontTestimonialFormType;
use NP\Bundle\GuestBookBundle\Form\Handler\FrontTestimonialFormHandler;

class FrontTestimonialController extends Controller {

    protected $max_per_page = 10;

    private function getClassRepository() {
        return $this->getDoctrine()->getRepository('NPGuestBookBundle:Testimonial');
    }

    public function indexAction() {
        $query = $this->getClassRepository()->findByStatusQuery('validated');

        $pagination = $this->get('knp_paginator')
                ->paginate($query, $request->query->get('page', 1), $this->max_per_page);

        return $this->render('NPGuestBookBundle:FrontTestimonial:index.html.twig', array(
                    'pagination' => $pagination
                ));
    }

    public function newAction() {
        $entity = new Testimonial();

        $form = $this->createForm(new FrontTestimonialFormType(), $entity);

        $handler = new FrontTestimonialFormHandler(
                        $this->getRequest(),
                        $this->getDoctrine()->getEntityManager()
        );

        if ($handler->process($form, $entity)) {
            $this->get('session')->setFlash('success', $this->get('translator')->trans(
                            'front.testimonial.flash.success.new', array(), 'NPGuestBookBundle')
            );

            return $this->redirect($this->generateUrl('np_guest_book_fronttestimonial_index'));
        }

        return $this->render('NPGuestBookBundle:FrontTestimonial:new.html.twig', array(
                    'form' => $form->createView()
                ));
    }

}
