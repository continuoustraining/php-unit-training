<?php

namespace ContinuousUnit\Gateway;

use Slim\Container;

class RedisFactory
{
    /**
     * @param Container $container
     * @return \Redis
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __invoke(Container $container): \Redis
    {
        $redis = new \Redis();
        $config = $container->get('redisConfig');
        $redis->connect($config['host']);
        return $redis;
    }
}
