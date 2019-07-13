# php-unit-training
PHPUnit training by Continuous

# Exercice 6
Install Slim Framework

    $ composer require slim/slim "^3.0"

Change index.php to house this setup code

    ```
    <?php
        use \Psr\Http\Message\ServerRequestInterface as Request;
        use \Psr\Http\Message\ResponseInterface as Response;
        require '../vendor/autoload.php';
        $app = new \Slim\App;
        $app->get('/', function (Request $request, Response $response) {
            $response->getBody()->write("Hello, Unit testers");
            return $response;
        });

        $app->group('/users', function(){
            $this->map(['GET'], '', function (Request $request, Response $response) {
                return $response->withJson(['message' => 'API for Unit testers']);
            });

            $this->get('/{id}', function (Request $request, Response $response, $args) {
                return $response->withJson(['message' => "User ".$args['id']]);
            });
        });

        $app->run();

    ```


And you should see a Json response with "*API for Unit testers*" on http://localhost:8000/users