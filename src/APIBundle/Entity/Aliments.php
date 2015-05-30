<?php

namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aliments
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APIBundle\Entity\AlimentsRepository")
 */
class Aliments
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
     * @var integer
     *
     * @ORM\Column(name="name", type="string", length=70)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="calorie", type="integer")
     */
    private $calorie;


    /**
     *
     * @ORM\ManyToOne(targetEntity="uniteMesure")
     *
     */
    private $uniteMesure;



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
     * @return Aliments
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
     * @return Aliments
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
     * Set uniteMesure
     *
     * @param \APIBundle\Entity\uniteMesure $uniteMesure
     * @return Aliments
     */
    public function setUniteMesure(\APIBundle\Entity\uniteMesure $uniteMesure = null)
    {
        $this->uniteMesure = $uniteMesure;

        return $this;
    }

    /**
     * Get uniteMesure
     *
     * @return \APIBundle\Entity\uniteMesure 
     */
    public function getUniteMesure()
    {
        return $this->uniteMesure;
    }
}
