<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/books/{isbn}/{lccn}', function ($request, $response, $args){
    $isbn = $args['isbn'];
    $lccn = $args['lccn'];

    $res = $this->guzzleClient->request('GET', "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn,LCCN:$lccn&format=json");;

    $book = $res->getBody()->getContents();

    return $response->write($book);
    // return $response->withJson($book);
});
