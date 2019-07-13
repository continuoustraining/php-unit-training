<?php

namespace ContinuousUnit\Service;

use Slim\Container;

class UserServiceFactory
{
    /**
     * @param Container $container
     * @return UserService
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __invoke(Container $container): UserService
    {
        return new UserService(
            $container->get('userGateway'),
            $container->get('userHydrator')
        );
    }
}
