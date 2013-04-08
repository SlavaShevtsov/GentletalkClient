<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */

include_once 'Model/Resource.php';
include_once 'Entity/Message.php';
include_once 'Entity/Ban.php';
include_once 'Entity/Unban.php';
include_once 'Model/Response.php';
include_once 'Model/Server.php';

include_once 'Model/Forum.php';
include_once 'Entity/ForumMessage.php';
include_once 'Entity/ForumUnban.php';
include_once 'Entity/ForumBan.php';

$forum = new Forum();
$forum->setId(1);
$forum->setToken('token1');
$forum->setServer(new Server());

sendMessagesSample($forum);
getBansSample($forum);
getUnbansSample($forum);

exit;

/* ===== */

/**
 * @param Forum $forum
 */
function sendMessagesSample(Forum $forum)
{
    $message = new ForumMessage();
    $message->setMessageId('id2');
    $message->setThreadId('id3');
    $message->setCreated(new \DateTime);
    $message->setUrl('www.forum.com');
    $message->setAuthorId('id1');
    $message->setNickname('nickname');
    $message->setSubject('subject');
    $message->setMessage('message');

    echo "Send message\n";
    $forum->addMessage($message);
    if ($forum->sendMessages()) {
        echo "Success\n";
    } else {
        echo 'Error: ' . $forum->getResponse()->status . ' (' . $forum->getResponse()->content . ")\n";
    }
}

/**
 * @param Forum $forum
 */
function getBansSample(Forum $forum)
{
    $from   = new \DateTime();
    $to     = new \DateTime();
    
    $from->setTimestamp($from->getTimestamp() - 24 * 3600);

    echo "Get bans\n";
    $bans = $forum->getBansForPeriod($from, $to);
    if (is_array($bans)) {
        echo "Success\n";
    } else {
        echo 'Error: ' . $forum->getResponse()->status . ' (' . $forum->getResponse()->content . ")\n";
    }
}

/**
 * @param Forum $forum
 */
function getUnbansSample(Forum $forum)
{
    $from   = new \DateTime();
    $to     = new \DateTime();

    $from->setTimestamp($from->getTimestamp() - 24 * 3600);
    
    echo "Get unbans\n";
    $unbans = $forum->getUnbansForPeriod($from, $to);
    if (is_array($unbans)) {
        echo "Success\n";
    } else {
        echo 'Error: ' . $forum->getResponse()->status . ' (' . $forum->getResponse()->content . ")\n";
    }
}
