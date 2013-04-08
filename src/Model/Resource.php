<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
abstract class Resource
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $token;
    
    /**
     * @var array
     */
    protected $messages;
    
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Server
     */
    protected $server;
    
    /**
     * @var string
     */
    protected $domain = 'http://gentletalk.com';

    public function __construct()
    {
        $this->id       = 0;
        $this->token    = '';
        $this->messages = array();
        $this->response = null;
        $this->server   = null;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }
    
    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
    
    /**
     * @param Server $server
     */
    public function setServer(Server $server)
    {
        $this->server = $server;
    }
    
    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * Add message to buffer.
     * @param Message $message
     */
    abstract public function addMessage($message);

    /**
     * Send $messages and buffered messages to the service.
     * @param array $messages
     */
    public function sendMessages($messages = null)
    {
        if (is_array($messages)) {
            foreach ($messages as $message) {
                $this->addMessage($message);
            }
        }
        
        $url = $this->domain . $this->urlPrefix . $this->id . '/messages';
        
        $request = array(
            'token'     => $this->token, 
            'messages'  => $this->messages,
        );
        
        $this->messages = array();
        
        $this->response = $this->server->post($url, json_encode($request));
        
        return (201 == $this->response->status);
    }

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function getBansForPeriod(\DateTime $from, \DateTime $to)
    {
        $url = $this->domain . $this->urlPrefix . $this->id . '/bans';
        
        $request = array(
            'token' => $this->token, 
            'from'  => $from->format('Y-m-d H:i:s'),
            'to'    => $to->format('Y-m-d H:i:s'),
        );
        
        $this->response = $this->server->get($url, json_encode($request));
        
        if (200 != $this->response->status) {
            return null;
        }
        
        $array = json_decode($this->response->content, true);
        $bans = array();
        if (!is_null($array)) {
            foreach ($array['bans'] as $raw) {
                $bans[] = $this->arrayToBanEntity($raw);
            }
        }
        
        return $bans;
    }
    
    /**
     * @param array $raw
     * @return Ban
     */
    abstract protected function arrayToBanEntity(array $raw);
    
    /**
     * @param \DateTime $from
     * @param \DateTime $to
     */
    public function getUnbansForPeriod(\DateTime $from, \DateTime $to)
    {
        $url = $this->domain . $this->urlPrefix . $this->id . '/unbans';
        
        $request = array(
            'token' => $this->token, 
            'from'  => $from->format('Y-m-d H:i:s'),
            'to'    => $to->format('Y-m-d H:i:s'),
        );
        
        $this->response = $this->server->get($url, json_encode($request));
        
        if (200 != $this->response->status) {
            return null;
        }
        
        $array = json_decode($this->response->content, true);
        $unbans = array();
        if (!is_null($array)) {
            foreach ($array['unbans'] as $raw) {
                $unbans[] = $this->arrayToUnbanEntity($raw);
            }
        }
        
        return $unbans;
    }

    /**
     * @param array $raw
     * @return Unban
     */
    abstract protected function arrayToUnbanEntity(array $raw);
}
