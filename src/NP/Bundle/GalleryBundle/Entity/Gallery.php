<?php

namespace NP\Bundle\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Gallery
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NP\Bundle\GalleryBundle\Entity\GalleryRepository")
 */
class Gallery {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Picture", mappedBy="parent", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $pictures;

    public function __construct() {
	$this->pictures = new ArrayCollection();
    }

    /*
     * @return string
     */
    public function __toString() {
	return $this->title;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
	return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
	return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Gallery
     */
    public function setTitle($title) {
	$this->title = $title;

	return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
	return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Gallery
     */
    public function setDescription($description) {
	$this->description = $description;

	return $this;
    }

    /**
     * Get pictures
     *
     * @return array_collection
     */
    public function getPictures() {
		return $this->pictures;
    }

    /**
     * Add picture
     *
     * @param \NP\Bundle\GalleryBundle\Entity\Picture $picture
     */
    public function addPicture(Picture $picture) {
	if (!$this->pictures->contains($picture)) {
	    $picture->setParent($this);
	    $this->pictures->add($picture);
	}
    }

    /**
     * Remove picture
     *
     * @param \NP\Bundle\GalleryBundle\Entity\Picture $picture
     */
    public function removePicture(Picture $picture) {
	if ($this->pictures->contains($picture)) {
	    $this->pictures->removeElement($picture);
	}
    }

}
