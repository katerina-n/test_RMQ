<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_mail",indexes={@ORM\Index(name="creator_isSend", columns={"creator", "isSend"})})
 * @ORM\Entity()
 */
class UserMail
{

    public function onPrePersist()
    {
        $this->createDate = new \DateTime();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="userEmails")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     *
     **/
    private $creator;

    /**
     * @var string
     * @ORM\Column(name="send_to", type="string", nullable=false)
     */
    private $sendTo;

    /**
     * @var string
     * @ORM\Column(name="message", type="string", nullable=false)
     */
    private $message;

    /**
     * @var \DateTime $createDate
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     *
     */
    private $createDate;

    /**
     * @var boolean $isSend
     * @ORM\Column(name="is_send", type="boolean")
     */
    private $isSend = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSendTo()
    {
        return $this->sendTo;
    }

    /**
     * @param string $sendTo
     * @return $this
     */
    public function setSendTo(string $sendTo)
    {
        $this->sendTo = $sendTo;
        return $this;
    }


    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     * @return $this
     */
    public function setCreateDate(\DateTime $createDate)
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param $creator
     * @return $this
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsSend()
    {
        return $this->isSend;
    }

    /**
     * @param bool $isSend
     * @return $this
     */
    public function setIsSend($isSend)
    {
        $this->isSend = $isSend;

        return $this;
    }



}