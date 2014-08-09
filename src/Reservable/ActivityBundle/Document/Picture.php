<?php
namespace Reservable\ActivityBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @MongoDB\Document
 */
class Picture
{
   /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $picPath;

    /**
     * @MongoDB\Field(type="file")
     *
     * @Assert\File(maxSize="6000000")
     */
    private $picFile;

    /**
     * @MongoDB\Field(type="string")
     *
     * @Assert\NotBlank(message="Actividad no encontrada.")
     * @MongoDB\ReferenceOne(targetDocument="Activity")
     */
    protected $activityID;

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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setPicFile(UploadedFile $picFile = null)
    {
        $this->picFile = $picFile;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getPicFile()
    {
        return $this->picFile;
    }
    /**
     * Set picPath
     *
     * @param string $picPath
     * @return Picture
     */
    public function setPicPath($picPath)
    {
        $this->picPath = $picPath;

        return $this;
    }

    /**
     * Get picPath
     *
     * @return string
     */
    public function getPicPath()
    {
        return $this->picPath;
    }

    public function getPicAbsoluteWebPath()
    {
        return null === $this->picPath
            ? null
            : $this->getUploadRootPicDir().'/'.$this->picPath;
    }

    public function getWebPicPath()
    {
        return null === $this->picPath
            ? null
            : $this->getUploadPicDir();
    }

    public function getUploadRootPicDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadPicDir();
    }

    public function getUploadPicDir()
    {
        return 'images/instalations/';
    }
    
    public function upload()
    {
        if (null === $this->getPicFile()) {
            return;
        }

        $this -> getPicFile()->move(
            $this->getUploadRootPicDir(),
            $this->getPicFile()->getClientOriginalName()
        );


        $this->picPath = $this->getUploadPicDir().$this->getPicFile()->getClientOriginalName();

        $this->picFile = null;

    }

    /**
     * Set setActivityID
     *
     * @param string $activityID
     * @return self
     */
    public function setActivityID($activityID)
    {
        $this->activityID = $activityID;
        return $this;
    }

    /**
     * Get getActivityID
     *
     * @return string $activityID
     */
    public function getActivityID()
    {
        return $this->activityID;
    }
}
