<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello, Unit testers");
    return $response;
});

$app->group('/users', function () {
    $this->map(['GET'], '', function (Request $request, Response $response) {
        return $response->withJson(['message' => 'API for Unit testers']);
    });

    $this->get('/{id}', function (Request $request, Response $response, $args) {
        return $response->withJson(['message' => "User ".$args['id']]);
    });
});

$app->run();
