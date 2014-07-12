<?php

/*
 * This file is part of the Symfocal Calendar v1.
 *
 * (c) Symfocal http://www.symfocal.com
 * alban@symfocal.com
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dp\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dp\CalendarBundle\Entity\State
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dp\CalendarBundle\Entity\StateRepository")
 */
class State
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Dp\CalendarBundle\Entity\Booking", mappedBy="state", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC", "id" = "DESC"})
     */
    private $bookings;
    
    public function __construct()
    {
    $this->bookings = new ArrayCollection();

    }
    
    public function getBookings()
    {
        return $this->bookings;
    }

    public function setBookings(\Doctrine\Common\Collections\Collection $bookings)
    {
        foreach ($bookings as $booking) {
        $booking->setState($this);
        }
        
        $this->bookings = $bookings;
    }
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $class
     * @Assert\Regex(pattern="#^[a-zA-Z0-9-_]+$#", message="The class field can only contain letters, numbers and the signs - _ (no spaces allowed).")
     * @ORM\Column(name="class", type="string", length=255)
     */
    private $class;

    /**
     * @var integer $position
     *
     * @ORM\Column(name="position", type="smallint")
     */
    private $position;


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
     * @return state
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
     * Set class
     *
     * @param string $class
     * @return state
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return state
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
