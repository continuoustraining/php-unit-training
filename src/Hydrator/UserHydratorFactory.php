<?php

namespace ContinuousUnit\Hydrator;

use Slim\Container;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Reflection;

class UserHydratorFactory
{
    /**
     * @param Container $container
     * @return HydratorInterface
     */
    public function __invoke(Container $container): HydratorInterface
    {
        $hydrator = new Reflection();
        return $hydrator;
    }
}
