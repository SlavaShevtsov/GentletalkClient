<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class Forum extends Resource
{
    protected $urlPrefix = '/api/forum/';

    /**
     * Add message to buffer.
     * @param ForumMessage $message
     */
    public function addMessage($message)
    {
        $mess = array (
            'messageId' => $message->getMessageId(),
            'threadId'  => $message->getThreadId(),
            'created'   => $message->getCreated()->format('Y-m-d H:i:s'),
            'url'       => $message->getUrl(),
            'authorId'  => $message->getAuthorId(),
            'nickname'  => $message->getNickname(),
            'subject'   => $message->getSubject(),
            'message'   => $message->getMessage(),
        );
        
        $this->messages[] = $mess;
    }
    
    /**
     * @param array $raw
     * @return ForumBan
     */
    protected function arrayToBanEntity(array $raw)
    {
        $ban = new ForumBan();
        
        $ban->forumId           = $raw['forumId'];
        $ban->banId             = $raw['banId'];
        $ban->messageId         = $raw['messageId'];
        $ban->authorId          = $raw['authorId'];
        $ban->nickname          = $raw['nickname'];
        $ban->created           = $raw['created'];
        $ban->moderatorNickname = $raw['moderatorNickname'];
        $ban->type              = $raw['type'];
        $ban->weight            = $raw['weight'];
        $ban->text              = $raw['text'];
    
        return $ban;
    }

    /**
     * @param array $raw
     * @return ForumUnban
     */
    protected function arrayToUnbanEntity(array $raw)
    {
        $unban = new ForumUnban();
        
        $unban->forumId          = $raw['forumId'];
        $unban->banId            = $raw['banId'];
        $unban->messageId        = $raw['messageId'];
        $unban->authorId         = $raw['authorId'];
        $unban->nickname         = $raw['nickname'];
        $unban->created          = $raw['created'];
        $unban->moderatorNickname= $raw['moderatorNickname'];
        $unban->text             = $raw['text'];
    
        return $unban;    
    }
}
