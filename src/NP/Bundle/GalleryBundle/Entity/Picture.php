<?php

namespace NP\Bundle\GalleryBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use NP\Bundle\CoreBundle\Util\Urlizer;
use Symfony\Component\Filesystem\Filesystem;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

/**
 * Picture
 *
 * @ORM\Table("gallery_picture")
 * @ORM\Entity(repositoryClass="NP\Bundle\GalleryBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Picture {
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */

use TimestampableEntity;

    protected static $FILE_TYPES = array(
	'small' => array('width' => 90, 'height' => 78, 'thumbnail_type' => ImageInterface::THUMBNAIL_OUTBOUND),
	'thumb' => array('width' => 150, 'height' => 113, 'thumbnail_type' => ImageInterface::THUMBNAIL_OUTBOUND),
	'medium' => array('width' => 233, 'height' => 155, 'thumbnail_type' => ImageInterface::THUMBNAIL_OUTBOUND),
	'big' => array('width' => 1024, 'height' => 768, 'thumbnail_type' => ImageInterface::THUMBNAIL_INSET)
    );

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
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="pictures")
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     * @var Gallery
     */
    private $parent;

    /**
     * @Assert\File(maxSize="5M")
     * @Assert\Image()
     */
    private $file;

    /**
     * @var extension
     *
     * @ORM\Column(name="extension", type="text")
     */
    private $extension;

    /**
     * @var path
     *
     * @ORM\Column(name="path", type="text")
     */
    private $path;

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
     * Set file
     *
     * @param mixed $file
     */
    public function setFile($file) {
	if ($file != $this->file) {
	    $this->updated_at = new \DateTime();
	    $this->file = $file;
	}
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile() {
	return $this->file;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension() {
	return $this->extension;
    }

    /**
     * Set description
     *
     * @param string $extension
     * @return Resources
     */
    public function setExtension($extension) {
	$this->extension = $extension;

	return $this;
    }

    /**
     * Set gallery
     *
     * @param \NP\Bundle\GalleryBundle\Entity\Gallery $gallery
     * @return Picture
     */
    public function setParent($gallery = null) {
	$this->parent = $gallery;

	return $this;
    }

    /**
     * Get gallery
     *
     * @return \NP\Bundle\GalleryBundle\Entity\Gallery
     */
    public function getParent() {
	return $this->parent;
    }

    public function getFileName($type) {
	return sprintf('img-%s-%d.'.$this->extension, $type, $this->getId());
    }

    public function getFolderName() {
	return sprintf('gallery-%d', $this->getParent()->getId());
    }

    /**
     * Get url for a type of image
     *
     * @param string $type
     * @return string
     */
    public function getUrl($type = 'small') {
	if ($this->getParent() == null) {
	    return '';
	}

	if (!in_array($type, array_keys(self::$FILE_TYPES))) {
	    $type = 'medium';
	}
	return $this->getWebPath() . '/' . $this->getFileName($type);
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
	if (null !== $this->file) {
            $this->extension = $this->file->guessExtension();
            $this->path = $this->file->getClientOriginalName();
	    if (!is_dir($this->getFilePath())) {
		$filesystem = new Filesystem();
		$filesystem->mkdir($this->getFilePath());
	    }
	}
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
	if (null === $this->file) {
	    return;
	}
        $this->extension = $this->file->guessExtension();
        $this->path = $this->file->getClientOriginalName();
	$tmp_filename = 'tmp-' . $this->getId();
	$this->file->move($this->getFilePath(), $tmp_filename);

	$imagine = new Imagine();
	$imagine->open($this->getFilePath() . '/' . $tmp_filename)
		->save($this->getFilePath() . '/' . $this->getFileName('orig'));

	$filesystem = new Filesystem();
	$filesystem->remove($this->getFilePath() . '/' . $tmp_filename);

	foreach (self::$FILE_TYPES as $type => $params) {
	    $size = new Box($params['width'], $params['height']);
	    $imagine->open($this->getFilePath() . '/' . $this->getFileName('orig'))
		    ->thumbnail($size, $params['thumbnail_type'])
		    ->save($this->getFilePath() . '/' . $this->getFileName($type), array('quality' => 80));
	}

	unset($this->file);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeUpload() {
	$filesystem = new Filesystem();
	$filesystem->remove($this->getFilePath() . '/' . $this->getFileName('orig'));
	foreach (self::$FILE_TYPES as $type => $dim) {
	    $filesystem->remove($this->getFilePath() . '/' . $this->getFileName($type));
	}
    }

    public function getAbsolutePath($type) {
	return $this->getFilePath() . '/' . $this->getFileName($type);
    }

    public function getWebPath() {
	return $this->getUploadDir() . '/' . $this->getFolderName();
    }

    public function getFilePath() {
	return $this->getUploadRootDir() . '/' . $this->getFolderName();
    }

    protected function getUploadRootDir() {
	// the absolute directory path where uploaded documents should be saved
	return __DIR__ . '/../../../../../www' . $this->getUploadDir();
    }

    protected function getUploadDir() {
	// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
	return '/upload';
    }

}