<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class GameServer extends Resource
{
    protected $urlPrefix = '/api/game_server/';

    /**
     * Add message to buffer.
     * @param GameMessage $message
     */
    public function addMessage($message)
    {
        $mess = array (
            'messageId' => $message->getMessageId(),
            'roomId'    => $message->getRoomId(),
            'created'   => $message->getCreated()->format('Y-m-d H:i:s'),
            'authorId'  => $message->getAuthorId(),
            'nickname'  => $message->getNickname(),
            'message'   => $message->getMessage(),
        );
        
        $this->messages[] = $mess;
    }
    
    /**
     * @param array $raw
     * @return GameBan
     */
    protected function arrayToBanEntity(array $raw)
    {
        $ban = new GameBan();
        
        $ban->banId             = $raw['banId'];
        $ban->messageId         = $raw['messageId'];
        $ban->authorId          = $raw['authorId'];
        $ban->nickname          = $raw['nickname'];
        $ban->created           = $raw['created'];
        $ban->moderatorNickname = $raw['moderatorNickname'];
        $ban->type              = $raw['type'];
        $ban->weight            = $raw['weight'];
        $ban->text              = $raw['text'];
        $ban->gameId            = $raw['gameId'];
        $ban->serverId          = $raw['serverId'];
        $ban->roomId            = $raw['roomId'];
    
        return $ban;
    }

    /**
     * @param array $raw
     * @return ForumUnban
     */
    protected function arrayToUnbanEntity(array $raw)
    {
        $unban = new GameUnban();
        
        $unban->banId            = $raw['banId'];
        $unban->messageId        = $raw['messageId'];
        $unban->authorId         = $raw['authorId'];
        $unban->nickname         = $raw['nickname'];
        $unban->created          = $raw['created'];
        $unban->moderatorNickname= $raw['moderatorNickname'];
        $unban->text             = $raw['text'];
        $unban->gameId           = $raw['gameId'];
        $unban->serverId         = $raw['serverId'];
    
        return $unban;    
    }
}
