<?php

namespace ContinuousUnitTest;

use PHPUnit\Framework\TestCase;
use Slim\Http\Environment;
use Slim\Http\Request;
use ContinuousUnit\App;

class AppTest extends TestCase
{
    protected $app;

    public function setUp()
    {
        $this->app = (new App())->get();
    }

    public function testUsersGet()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/',
            ]);
        $req = Request::createFromEnvironment($env);

        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertSame((string) $response->getBody(), "Hello, Unit testers");
    }

    public function testUsersGetAll()
    {
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/users',
            ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;

        $response = $this->app->run(true);
        $this->assertSame($response->getStatusCode(), 200);

        $result = json_decode($response->getBody(), true);
        $this->assertSame($result["message"], "API for Unit testers");
    }
}
