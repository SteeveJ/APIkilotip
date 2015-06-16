<?php

namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archive
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APIBundle\Entity\ArchiveRepository")
 */
class Archive
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="calorie", type="integer")
     */
    private $calorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * @return Archive
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set calorie
     *
     * @param integer $calorie
     * @return Archive
     */
    public function setCalorie($calorie)
    {
        $this->calorie = $calorie;

        return $this;
    }

    /**
     * Get calorie
     *
     * @return integer 
     */
    public function getCalorie()
    {
        return $this->calorie;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Archive
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
