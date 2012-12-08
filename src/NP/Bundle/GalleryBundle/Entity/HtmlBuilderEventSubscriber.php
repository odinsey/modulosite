<?php

namespace NP\Bundle\GalleryBundle\Entity;

use Doctrine\ORM\Events;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\EventSubscriber;
use NP\Bundle\CoreBundle\Util\Urlizer;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HtmlBuilderEventSubscriber implements EventSubscriber {

	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * Constructor
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container){
		$this->container = $container;
	}

	public function getSubscribedEvents(){
		return array(
			Events::preRemove, //Picture::preRemove, Gallery::preRemove
			Events::postRemove, //Picture::preRemove, Gallery::preRemove
			//Events::postPersist, //Picture::postPersist, Gallery::postPersist
			Events::preUpdate, //Picture::preUpdate, Gallery::preUpdate
			Events::postUpdate, //Picture::postUpdate, Gallery::postUpdate
		);
	}

	public function preRemove(LifecycleEventArgs $args){
		$entity = $args->getEntity();
		if( $entity instanceof Picture ){
			$entity->storeFilenameForRemove();
		}elseif( $entity instanceof Gallery ){

		}
	}

	public function postRemove(LifecycleEventArgs $args){
		$entity = $args->getEntity();
		if( $entity instanceof Picture ){
			$entity->removeUpload();
		}elseif( $entity instanceof Gallery ){

		}
	}

	public function preUpdate(PreUpdateEventArgs $args){
		$entity = $args->getEntity();
		if( $entity instanceof Picture ){
			$entity->setUpdated(new \DateTime());
			$this->upload($entity);
			var_dump($entity);exit;
		}
	}

//	public function postUpdate(LifecycleEventArgs $args){
//		$this->postPersist($args);
//	}

//	public function postPersist(LifecycleEventArgs $args){
//		$entity = $args->getEntity();
//		$em = $args->getEntityManager();
//
//		if( $entity instanceof Picture ){
//			$entity->upload();
//		}
//	}
}
