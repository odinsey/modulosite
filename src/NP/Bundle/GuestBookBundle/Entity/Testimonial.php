<?php

namespace NP\Bundle\GuestBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use NP\Bundle\GuestBookBundle\Enum\StatusEnum;

/**
 * NP\Bundle\GuestBookBundle\Entity\Testimonial
 *
 * @ORM\Table(name="testimonial")
 * @ORM\Entity(repositoryClass="NP\Bundle\GuestBookBundle\Entity\Repository\TestimonialRepository")
 */
class Testimonial
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", length=20)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\MaxLength(50)
     * @Assert\MinLength(2)
     */
    protected $name;
    
    /**
     * @var string $text
     *
     * @ORM\Column(name="text", type="text")
     * @Assert\MaxLength(500)
     * @Assert\MinLength(2)
     */
    protected $text;
    
    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=50)
     * @Assert\Choice(callback = {"NP\Bundle\GuestBookBundle\Enum\StatusEnum", "getValues"})
     */
    protected $status;
    
    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $created_at;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set created_at
     *
     * @param datetime $created_at
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    public function __construct()
    {
        $this->created_at = new \DateTime('now');
        $this->status = StatusEnum::PENDING;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}