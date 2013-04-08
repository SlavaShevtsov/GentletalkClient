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

include_once 'Model/GameServer.php';
include_once 'Entity/GameMessage.php';
include_once 'Entity/GameUnban.php';
include_once 'Entity/GameBan.php';

$server = new GameServer();
$server->setId(1);
$server->setToken('token1');
$server->setServer(new Server());

sendMessagesSample($server);
getBansSample($server);
getUnbansSample($server);

exit;

/* ===== */

/**
 * @param GameServer $server
 */
function sendMessagesSample(GameServer $server)
{
    $message = new GameMessage();
    $message->setMessageId('id1');
    $message->setRoomId('id2');
    $message->setCreated(new \DateTime);
    $message->setAuthorId('id1');
    $message->setNickname('nickname');
    $message->setMessage('message');

    echo "Send message\n";
    $server->addMessage($message);
    if ($server->sendMessages()) {
        echo "Success\n";
    } else {
        echo 'Error: ' . $server->getResponse()->status . ' (' . $server->getResponse()->content . ")\n";
    }
}

/**
 * @param GameServer $server
 */
function getBansSample(GameServer $server)
{
    $from   = new \DateTime();
    $to     = new \DateTime();
    
    $from->setTimestamp($from->getTimestamp() - 24 * 3600);

    echo "Get bans\n";
    $bans = $server->getBansForPeriod($from, $to);
    if (is_array($bans)) {
        echo "Success\n";
    } else {
        echo 'Error: ' . $server->getResponse()->status . ' (' . $server->getResponse()->content . ")\n";
    }
}

/**
 * @param GameServer $server
 */
function getUnbansSample(GameServer $server)
{
    $from   = new \DateTime();
    $to     = new \DateTime();

    $from->setTimestamp($from->getTimestamp() - 24 * 3600);
    
    echo "Get unbans\n";
    $unbans = $server->getUnbansForPeriod($from, $to);
    if (is_array($unbans)) {
        echo "Success\n";
    } else {
        echo 'Error: ' . $server->getResponse()->status . ' (' . $server->getResponse()->content . ")\n";
    }
}
