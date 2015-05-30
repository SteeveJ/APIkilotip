<?php

namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boisson
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APIBundle\Entity\BoissonRepository")
 */
class Boisson
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
     * @return int
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCalorie()
    {
        return $this->calorie;
    }

    /**
     * @param int $calorie
     */
    public function setCalorie($calorie)
    {
        $this->calorie = $calorie;
    }


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
     * Set uniteMesure
     *
     * @param \APIBundle\Entity\uniteMesure $uniteMesure
     * @return Boisson
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
