<?php

namespace JRs\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 * @ORM\HasLifecycleCallbacks
 */
class Comment {

    /**
     * @ORM\id
     * @ORM\Colum(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Colum(type="string")
     */
    protected $user;

    /**
     * @ORM\Colum(type="text")
     */
    protected $comment;

    /**
     * @ORM\Colum(type="boolean")
     */
    protected $approved;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comments")
     * @ORM\JoinColum(name="blog_id", referencedColumnName="id")
     */
    protected $blog;

    /**
     * @ORM\Colum(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Colum(type="datetime")
     */
    protected $updated

    public function __construct(){
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
        $this->setApproved(true);
    }

    /**
     * @ORM\preUpdate
     */
    public function setUpdateValue(){
        $this->setUpdated(new \DateTime());
    }
}