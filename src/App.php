<?php

namespace ContinuousUnit;

use ContinuousUnit\Gateway\UserGatewayFactory;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use ContinuousUnit\Entity\User;
use ContinuousUnit\Gateway\RedisFactory;
use ContinuousUnit\Hydrator\UserHydratorFactory;
use ContinuousUnit\Service\UserServiceFactory;

class App
{
    private $app;

    public function __construct()
    {
        $app = new \Slim\App($this->getSettings());
        $app = $this->setDependencies($app);

        $app->get('/', function (Request $request, Response $response) {
            $response->getBody()->write("Hello, Unit testers");
            return $response;
        });

        $app->group('/users', function () {
            $this->map(['GET'], '', function (Request $request, Response $response) {
                return $response->withJson(['message' => 'API for Unit testers']);
            });

            $this->get('/{id}', function (Request $request, Response $response, $args) {
                $result = $this->userHydrator->extract(
                    $this->userService->findOne($args['id'])
                );
                return $response->withStatus(200)->withJson($result);
            });

            $this->map(['POST', 'PUT'], '/{id}', function (Request $request, Response $response, $args) {
                $data = json_decode($request->getBody()->getContents(), true);
                $data['id'] = $args['id'];

                $user = $this->userHydrator->hydrate($data, new User());
                $result = $this->userHydrator->extract($this->userService->addUser($user));
                return $response->withStatus(201)->withJson($result);
            });
        });

        $this->app = $app;
    }

    public function get()
    {
        return $this->app; // get an instance of Slim App
    }

    public function getSettings()
    {
        return [
            'settings' => [
                'displayErrorDetails' => true,
            ],
            'redisConfig' => [
                'host' => 'redis'
            ]
        ];
    }

    public function setDependencies($app)
    {
        $container = $app->getContainer();
        $container['redis'] = new RedisFactory();
        $container['userGateway'] = new UserGatewayFactory();
        $container['userHydrator'] = new UserHydratorFactory();
        $container['userService'] = new UserServiceFactory();

        return $app;
    }
}
