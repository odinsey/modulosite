<?php

namespace NP\Bundle\GalleryBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use NP\Bundle\CoreBundle\Util\Urlizer;

/**
 * Picture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NP\Bundle\GalleryBundle\Entity\PictureRepository")
 */
class Picture {
    
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
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @Gedmo\SortableGroup
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="pictures")
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     * @var Gallery
     */
    private $gallery;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    // a property used temporarily while deleting
    private $filenameForRemove;

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
     * Set title
     *
     * @param string $title
     * @return Picture
     */
    public function setTitle($title) {
	$this->title = $title;

	return $this;
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
     * Set position
     *
     * @param integer $position
     * @return Picture
     */
    public function setPosition($position) {
	$this->position = $position;

	return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition() {
	return $this->position;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Picture
     */
    public function setPath($path) {
	$this->path = $path;

	return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath() {
	return $this->path;
    }

    /**
     * Set gallery
     *
     * @param \NP\Bundle\GalleryBundle\Entity\Gallery $gallery
     * @return Picture
     */
    public function setGallery(Gallery $gallery = null) {
	$this->gallery = $gallery;

	return $this;
    }

    /**
     * Get gallery
     *
     * @return \NP\Bundle\GalleryBundle\Entity\Gallery
     */
    public function getGallery() {
	return $this->gallery;
    }

    public function getAbsolutePath() {
	return null === $this->getPath() ? null : $this->getUploadRootDir() . '/' . $this->getPath();
    }

    public function getWebPath() {
	return null === $this->getPath() ? null : $this->getUploadDir() . '/' . $this->getPath();
    }

    protected function getUploadRootDir() {
	// the absolute directory path where uploaded documents should be saved
	return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
	// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
	return 'upload/';
    }

    public function upload() {
	// the file property can be empty if the field is not required
	if (null === $this->file) {
	    return;
	}
	
	$file_parts = pathinfo($this->file->getClientOriginalName());

	$sanitanized_name = $this->gallery . '-' . $this->id . '-' . Urlizer::Urlize($file_parts['filename']) . '.' . $file_parts['extension'];
	var_dump($sanitanized_name);exit;
	
	// move takes the target directory and then the target filename to move to
	$this->file->move($this->getUploadRootDir(), $sanitanized_name);

	// set the path property to the filename where you've saved the file
	$this->setPath($sanitanized_name);
	$this->flush();

	// clean up the file property as you won't need it anymore
	$this->file = null;
    }

    public function storeFilenameForRemove() {
	$this->filenameForRemove = $this->getAbsolutePath();
    }

    public function removeUpload() {
	if ($this->filenameForRemove) {
	    @unlink($this->filenameForRemove);
	}
    }

}