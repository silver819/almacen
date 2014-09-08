<?php
namespace Reservable\ActivityBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;


/**
 * @MongoDB\Document
 */
class Activity
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     *
     * @Assert\NotBlank(message="Es necesario indicar el nombre.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="El nombre es demasiado corto, debe tener más de 3 caracteres",
     *     maxMessage="El nombre es demasiado largo, debe tener menos de 255 caracteres.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;
    /**
     * @var float $price
     * @Assert\NotBlank(message="Es necesario indicar el precio")
     */
    protected $price;

    /**
     * @MongoDB\Field(type="string")
     *
     * @Assert\NotBlank(message="Usuario no encontrado.", groups={"Registration", "Profile"})
     * @MongoDB\ReferenceOne(targetDocument="User")
     */
    protected $ownerID;

    /**
     * @MongoDB\Field(type="string")
     *
     * @Assert\NotBlank(message="Seleccione un tipo.")
     */
    protected $typeRent;

    /**
     * @MongoDB\Field(type="address")
     *
     * @Assert\NotBlank(message="Indique la dirección")
     */
    protected $address;

    /**
     * @MongoDB\Field(type="float")
     *
     */
    protected $lat;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $long;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $active;

    /**
     * @MongoDB\Field(type="feature")
     *
     * @Assert\NotBlank(message="Indique el tipo")
     */
    protected $feature;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set ownerID
     *
     * @param string $ownerID
     * @return self
     */
    public function setOwnerID($ownerID)
    {
        $this->ownerID = $ownerID;
        return $this;
    }

    /**
     * Get ownerID
     *
     * @return string $ownerID
     */
    public function getOwnerID()
    {
        return $this->ownerID;
    }

    /**
     * Set typeRent
     *
     * @param string $typeRent
     * @return self
     */
    public function setTypeRent($typeRent)
    {
        $this->typeRent = $typeRent;
        return $this;
    }

    /**
     * Get typeRent
     *
     * @return string $typeRent
     */
    public function gettypeRent()
    {
        return $this->typeRent;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return string
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get lat
     *
     * @return float $lat
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return float
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * Get long
     *
     * @return float $long
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set long
     *
     * @param float $long
     * @return float
     */
    public function setLong($long)
    {
        $this->long = $long;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return string
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get active
     *
     * @return int $active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @return int
     */
    public function setActive()
    {
        $this->active = 1;
        return $this;
    }

    /**
     * Set deactive
     *
     * @return int
     */
    public function setDeactive()
    {
        $this->active = 0;
        return $this;
    }

    /**
     * Set feature
     *
     * @param string $feature
     * @return self
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;
        return $this;
    }

    /**
     * Get feature
     *
     * @return string $feature
     */
    public function getFeature()
    {
        return $this->feature;
    }
}
