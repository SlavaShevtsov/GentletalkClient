<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class Message
{
    const STRING_MAX_LEN = 250;
    const TEXT_MAX_LEN = 65000;

    /**
     * @var string
     */
    protected $authorId;
    
    /**
     * GMT
     * @var \DataTime 
     */
    protected $created;
    
    /**
     * @var string
     */
    protected $message;
    
    /**
     * @var string
     */
    protected $messageId;
    
    /**
     * @var nickname
     */
    protected $nickname;

    /**
     * @param string $id
     */
    public function setAuthorId($id)
    {
        $this->authorId = substr($id, 0, self::STRING_MAX_LEN);
    }

    /**
     * @param \DateTime $date
     */
    public function setCreated(\DateTime $date)
    {
        $this->created = $date;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = substr($message, 0, self::STRING_MAX_LEN);
    }

    /**
     * @param string $id
     */
    public function setMessageId($id)
    {
        $this->messageId = substr($id, 0, self::STRING_MAX_LEN);
    }

    /**
     * @param string $nickname 
     */
    public function setNickname($nickname)
    {
        $this->nickname = substr($nickname, 0, self::STRING_MAX_LEN);
    }

    /**
     * @return string
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }
    
    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }
    
    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }
}

