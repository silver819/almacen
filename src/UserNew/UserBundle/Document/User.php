<?php
// src/Acme/UserBundle/Document/User.php

namespace UserNew\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
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
     * @MongoDB\Field(type="string")
     *
     * @Assert\NotBlank(message="Es necesario indicar los apellidos.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="Los apellidos son demasiado cortos, deben tener más de 3 caracteres",
     *     maxMessage="Los apellidos son demasiado largos, deben tener menos de 255 caracteres.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $surname;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_USER');
    }

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
     * Set surname
     *
     * @param string $surname
     * @return self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * Get surname
     *
     * @return string $surname
     */
    public function getSurname()
    {
        return $this->surname;
    }
}
