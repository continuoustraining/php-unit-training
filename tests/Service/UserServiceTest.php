<?php
namespace ContinuousUnit\UnitTest\Service;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use ContinuousUnit\Entity\User;
use ContinuousUnit\Gateway\UserGateway;
use ContinuousUnit\Service\UserService;
use Zend\Hydrator\Reflection;

class UserServiceTest extends TestCase
{
    /** @var UserService $userService */
    protected $userService;

    /** @var UserGateway|MockObject $userGateway */
    protected $userGateway;

    protected function setUp()
    {
        $this->userGateway = $this->createMock(UserGateway::class);

        $userHydrator = new Reflection();

        $this->userService = new UserService(
            $this->userGateway,
            $userHydrator
        );
    }

    public function testAddUserActuallyReturnsUserWhenItSaves()
    {
        $user = new User();
        $user->setFirstname('rick');
        $user->setLastname('morty');
        $user->setPassword('84fff20659999e2b83b45c6851ec57dd');
        $user->setTemporaryAvatar('/rick-and-morty.png');

        $this->userGateway
            ->expects($this->once())
            ->method('createOrUpdate')
            ->with($this->userService->getUserHydrator()->extract($user))
            ->willReturn(true);

        $result = $this->userService->addUser($user);

        $this->assertInstanceOf(User::class, $result);
    }

    public function testFindUserActuallyReturnsUser()
    {
        $user = new User();
        $user->setFirstname('rick');
        $user->setLastname('morty');
        $user->setPassword('84fff20659999e2b83b45c6851ec57dd');
        $user->setTemporaryAvatar('/rick-and-morty.png');

        $this->userGateway
            ->expects($this->once())
            ->method('find')
            ->with('1')
            ->willReturn($this->userService->getUserHydrator()->extract($user));

        $result = $this->userService->findOne('1');

        $this->assertInstanceOf(User::class, $result);
    }
}
