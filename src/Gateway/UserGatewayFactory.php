<?php

namespace ContinuousUnit\Gateway;

use Slim\Container;

class UserGatewayFactory
{
    /**
     * @param Container $container
     * @return UserGateway
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __invoke(Container $container): UserGateway
    {
        return new UserGateway($container->get('redis'));
    }
}
