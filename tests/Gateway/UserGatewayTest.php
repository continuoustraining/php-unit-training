<?php

namespace ContinuousUnitTest\Gateway;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ContinuousUnit\Gateway\UserGateway;
use Redis;

class UserGatewayTest extends TestCase
{
    /** @var Redis|MockObject $redis */
    protected $redis;

    /** @var UserGateway $userGateway */
    protected $userGateway;

    protected function setUp()
    {
        $this->redis = $this->getMockBuilder(Redis::class)->getMock();
        $this->userGateway = new UserGateway($this->redis);
    }

    public function testFindOneActuallyReturnsUser()
    {
        $expectedUser['id'] = 1;
        $expectedUser['firstname'] = 'jin';
        $expectedUser['lastname'] = 'freecs';
        $expectedUser['temporaryAvatar'] = '/jin.gif';
        $expectedUser['password'] = '84fff20659999e2b83b45c6851ec57dd';

        $json = json_encode($expectedUser);

        $this->redis
            ->expects($this->once())
            ->method('getKeys')
            ->with('1')
            ->willReturn(true);

        $this->redis
            ->expects($this->once())
            ->method('get')
            ->with('1')
            ->willReturn($json);

        $expectedUser = json_decode($json, true);

        $result = $this->userGateway->find('1');

        $this->assertEquals($expectedUser, $result);
    }


    public function testFindOneReturnsExceptionWhenNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Can not find User with id \'1\'');
        $this->expectExceptionCode(404);

        $this->redis
            ->expects($this->once())
            ->method('getKeys')
            ->with('1')
            ->willReturn(false);
        $this->userGateway->find('1');
    }

    public function testCreateOrUpdateReturnsTrueWhenItSaves()
    {
        $user['firstname'] = 'jin';
        $user['lastname'] = 'freecs';
        $user['temporaryAvatar'] = '/jin.gif';
        $user['password'] = '84fff20659999e2b83b45c6851ec57dd';

        $this->redis
            ->expects($this->once())
            ->method('set')
            ->with('1', json_encode($user))
            ->willReturn(true);

        $user['id'] = '1';

        $this->assertTrue($this->userGateway->createOrUpdate($user));
    }
}
