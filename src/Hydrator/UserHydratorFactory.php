<?php

namespace ContinuousUnit\Hydrator;

use GeneratedHydrator\Configuration;
use Slim\Container;
use ContinuousUnit\Entity\User;
use Zend\Hydrator\HydratorInterface;

class UserHydratorFactory
{
    /**
     * @param Container $container
     * @return HydratorInterface
     */
    public function __invoke(Container $container): HydratorInterface
    {
        $config = new Configuration(User::class);
        $hydratorClass = $config->createFactory()->getHydratorClass();
        return new $hydratorClass;
    }
}
