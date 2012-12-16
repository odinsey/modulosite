<?php

namespace NP\Bundle\ResourcesBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Resources
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NP\Bundle\ResourcesBundle\Entity\ResourcesRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Resources {
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

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;

    /**
     * @Assert\File(maxSize="5M")
     * @Vich\UploadableField(mapping="resources_file", fileNameProperty="path")
     *
     * @var File $file
     */
    private $file;

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
     * @return Resources
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
     * @return Resources
     */
    public function setDescription($description) {
	$this->description = $description;

	return $this;
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
     * Get url for a type of image
     *
     * @param string $type
     * @return string
     */
    public function getUrl($type = 'small') {
	return $this->getWebPath() . '/' . $this->getFileName();
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
	$this->file->move( $this->getFilePath(), $this->file->getClientOriginalName() );

	unset($this->file);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeUpload() {
	$filesystem = new Filesystem();
	$filesystem->remove($this->getFilePath() . '/' . $this->getFileName());
    }


    public function getFileName() {
	return $this->path;
    }

    public function getAbsolutePath() {
	return $this->getFilePath() . '/' . $this->getFileName();
    }

    public function getWebPath() {
	return $this->getUploadDir();
    }

    public function getFilePath() {
	return $this->getUploadRootDir();
    }

    protected function getUploadRootDir() {
	// the absolute directory path where uploaded documents should be saved
	return __DIR__ . '/../../../../../web' . $this->getUploadDir();
    }

    protected function getUploadDir() {
	// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
	return '/upload/resources';
    }

}
