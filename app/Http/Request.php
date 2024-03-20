<?php

namespace App\Http;

class Request {

    private string $httpMethod;
    
    private $uri;
    
    private $body = [];

    private $headers = [];
    
    public function __construct() {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->body = $_REQUEST ?? [];
        $this->headers = getallheaders() ?? [];
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getUri(): string
    {
        return $this->uri;        
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;        
    }

    public function getBody(): array
    {
        return $this->body;   
    }

    public function get($field = null): mixed
    {
        return $this->body[ $field ] ?? null;
    }
}
