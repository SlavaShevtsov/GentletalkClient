<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class GameMessage extends Message
{
    /**
     * @var string
     */
    protected $roomId;

    /**
     * @param string $id
     */
    public function setRoomId($id)
    {
        $this->roomId = substr($id, 0, Message::STRING_MAX_LEN);
    }

    /**
     * @return string
     */
    public function getRoomId()
    {
        return $this->roomId;
    }
}
