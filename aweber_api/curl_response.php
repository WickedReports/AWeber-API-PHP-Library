<?php

# CurlResponse
#
# Author  Sean Huber - shuber@huberry.com
# Date    May 2008
#
# A basic CURL wrapper for PHP
#
# See the README for documentation/examples or http://php.net/curl for more information
# about the libcurl extension for PHP -- http://github.com/shuber/curl/tree/master
#

use GuzzleHttp\Psr7\Message;

class CurlResponse
{
    public $body = '';
    public $headers = array();

    public function __construct($response)
    {
        $response = Message::parseResponse($response);
        $this->headers = $response->getHeaders();
        $this->headers['Http-Version'] = $response->getProtocolVersion();
        $this->headers['Status-Code'] = $response->getStatusCode();
        $this->headers['Status'] = $response->getReasonPhrase();

        $this->body = $response->getBody();
    }

    public function __toString()
    {
        return $this->body->getContents();
    }

    public function headers(){
        return $this->headers;
    }
}
