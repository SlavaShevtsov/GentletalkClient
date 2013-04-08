<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class ForumMessage extends Message
{
    /**
     * @var string
     */
    protected $threadId;
    
    /**
     * @var string
     */
    protected $subject;
    
    /**
     * @var string
     */
    protected $url;

    /**
     * @param string $id
     */
    public function setThreadId($id)
    {
        $this->threadId = $id;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = substr($message, 0, Message::TEXT_MAX_LEN);
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = substr($subject, 0, Message::STRING_MAX_LEN);
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = substr($url, 0, Message::STRING_MAX_LEN);
    }

    /**
     * @return string
     */
    public function getThreadId()
    {
        return $this->threadId;
    }
    
    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}

