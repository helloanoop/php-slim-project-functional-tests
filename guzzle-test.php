<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

// Create a mock and queue two responses.
$mock = new MockHandler([
    new Response(200, ['X-Foo' => 'Bar']),
    new Response(202, ['Content-Length' => 0]),
    new RequestException("Error Communicating with Server", new Request('GET', 'test'))
]);

$handler = HandlerStack::create($mock);
$client = new Client(['handler' => $handler]);

// The first request is intercepted with the first response.
echo $client->request('GET', '/')->getStatusCode();
//> 200
// The second request is intercepted with the second response.
echo $client->request('GET', '/')->getStatusCode();
//> 202
