<?php

/**
 * @copyright 2013 Gentletalk
 * @author shevtsov
 */
class Server
{
    /**
     * @param string $url
     * @param string $jsonRequest
     * @return \Response
     */
    public function get($url, $jsonRequest)
    {
        return $this->request('GET', $url, $jsonRequest);
    }
    
    /**
     * @param string $url
     * @param string $jsonRequest
     * @return \Response
     */
    public function post($url, $jsonRequest)
    {
        return $this->request('POST', $url, $jsonRequest);
    }
    
    /**
     * @param string $method
     * @param string $url
     * @param string $jsonRequest
     * @return \Response
     */
    protected function request($method, $url, $jsonRequest)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($ch);
        
        $response = new Response();
        if (!curl_errno($ch)) {
            $response->content  = $resp;
            $response->status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        } else {
            $response->content  = curl_error($ch);
            $response->status   = curl_errno($ch);
        }
        
        return $response;
    }
}
