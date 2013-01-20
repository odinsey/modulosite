<?php

namespace NP\Bundle\GuestBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NP\Bundle\GuestBookBundle\Enum\StatusEnum;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use NP\Bundle\GuestBookBundle\Form\Type\FrontTestimonialFormType;
use NP\Bundle\GuestBookBundle\Form\Handler\TestimonialFormHandler;
use NP\Bundle\GuestBookBundle\Entity\Testimonial;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FrontTestimonialController extends Controller {

    private function getClassRepository() {
        return $this->getDoctrine()->getRepository('NPGuestBookBundle:Testimonial');
    }

    public function listAction() {
        $repository = $this->getClassRepository();
        $request = $this->getRequest();
        $items = $repository
            ->findByStatusQuery(StatusEnum::VALIDATED)
            ->execute();
        $format = $request->getRequestFormat();
        $datas = array();

        foreach ($items as $item) {
            $datas[] = array(
                'name' => $item->getName(),
                'text' => $item->getText(),
                'status' => $this->get('translator')->trans($item->getStatus(), array(), 'NPGuestBookBundle'),
                'created_at' => $item->getCreatedAt()
            );
        }


        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->serialize($datas, 'json');

        return $this->render('::base.' . $format . '.twig', array('data' => $json));
    }

	/*
	 *
	 *@Template()
	 */
    public function newAction() {

        $entity = new Testimonial();

		$form = $this->createForm(new FrontTestimonialFormType($entity));

        if($this->getRequest()->isMethod('POST')){
                $form->bindRequest($this->getRequest());

                if($form->isValid()){
                    $this->getDoctrine()->getEntityManager()->persist($form->getData());
                    $this->getDoctrine()->getEntityManager()->flush();

                    $this->get('session')->setFlash('success', $this->get('translator')->trans(
                        'front.testimonial.flash.success.new', array('%name%' => $entity), 'NPGuestBookBundle')
                    );
					$message = \Swift_Message::newInstance()
					        ->setSubject('Vous avez un nouveau témoignage sur votre livre d\'or')
					        ->setFrom('postmaster@coraloisirs.fr')
					        ->setTo('nicolas@pajon.net')
					        ->setBody(
					            $this->renderView(
					                '::email.html.twig',
                                                        array(
                                                            'name' => $form->getData()->getName(),
                                                            'message' => nl2br($form->getData()->getText()),
                                                            'url' => str_replace('testimonial_new', 'testimonial' , $_SERVER['SCRIPT_URI']).'/'
                                                        )
					            ),'text/html','utf-8'
					        )
                                                ->setCc('alain@atelier-45.fr');
					$this->get('mailer')->send($message);

                    return $this->redirect($this->getRequest()->headers->get('referer').'?confirm=1');
                } else {
                    $this->get('session')->setFlash('error', $this->get('translator')->trans(
                        'front.testimonial.flash.error.new', array('%name%' => $entity), 'NPGuestBookBundle')
                    );
                    return $this->redirect($this->getRequest()->headers->get('referer').'?confirm=0');
                }
        }
    }

}
