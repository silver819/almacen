<?php
// src/Acme/AccountBundle/Document/User.php
namespace Acme\AccountBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="users")
 * @MongoDBUnique(fields="email")
 */
class User
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // stupid simple encryption (please don't copy it!)
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $surname
     */
    protected $surname;

    /**
     * @var type:float $tfno
     */
    protected $tfno;


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

    /**
     * Set tfno
     *
     * @param type:float $tfno
     * @return self
     */
    public function setTfno($tfno)
    {
        $this->tfno = $tfno;
        return $this;
    }

    /**
     * Get tfno
     *
     * @return type:float $tfno
     */
    public function getTfno()
    {
        return $this->tfno;
    }
}
