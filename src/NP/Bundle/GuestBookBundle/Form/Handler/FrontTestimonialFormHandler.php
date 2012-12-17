<?php
namespace NP\Bundle\GuestBookBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use NP\Bundle\GuestBookBundle\Entity\Testimonial;

class FrontTestimonialFormHandler {
    
    protected $request;
    protected $em;

    public function __construct(Request $request, EntityManager $em)
    {
        $this->request = $request;
        $this->em = $em;
    }
    
    public function process(Form $form, Testimonial $entity)
    {
        if('POST' == $this->request->getMethod()) {
            $form->bindRequest($this->request);
            
            if($form->isValid()){
                $this->em->persist($entity);
                $this->em->flush();
                
                return true;
            }
        }
        return false;
    }
}