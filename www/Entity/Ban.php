<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
abstract class Ban
{
    /**
     * @var integer
     */
    public $banId;
    
    /**
     * message's id in your application
     * @var string
     */
    public $messageId;
    
    /**
     * author's id in your application
     * @var string
     */
    public $authorId;
    
    /**
     * author's nickname in your application
     * @var string
     */
    public $nickname;
    
    /**
     * Y-m-d H:i:s , GMT
     * @var string
     */
    public $created;
    
    /**
     * moderator's nickname in your application
     * @var string
     */
    public $moderatorNickname;

    /**
     * @var string
     */
    public $type;
    
    /**
     * @var integer
     */
    public $weight;
    
    /**
     * 0..240 characters
     * @var string
     */
    public $text;
}
