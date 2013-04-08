<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class GameBan extends Ban
{
    /**
     * @var string
     */
    public $gameId;
    
    /**
     * @var string
     */
    public $serverId;
    
    /**
     * @var string
     */
    public $roomId;
}