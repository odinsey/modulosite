<?php

namespace NP\Bundle\NewsBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * News
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NP\Bundle\NewsBundle\Entity\NewsRepository")
 */
class News {
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */

use TimestampableEntity;

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
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;

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
     * Get published
     *
     * @return boolean
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * Set published
     *
     * @return boolean
     */
    public function setPublished($published) {
        $this->published = $published;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function isPublished() {
        return $this->published ? true : false;
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
     * @return News
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
     * @return News
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
     * @param \NP\Bundle\NewsBundle\Entity\Picture $picture
     */
    public function addPicture(\NP\Bundle\NewsBundle\Entity\Picture $picture) {
        if (!$this->pictures->contains($picture)) {
            $picture->setParent($this);
            $this->pictures->add($picture);
        }
    }

    /**
     * Remove picture
     *
     * @param \NP\Bundle\NewsBundle\Entity\Picture $picture
     */
    public function removePicture(Picture $picture) {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
        }
    }

}
