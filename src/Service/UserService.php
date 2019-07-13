<?php

namespace ContinuousUnit\Service;

use ContinuousUnit\Entity\User;
use ContinuousUnit\Gateway\UserGateway;

use Zend\Hydrator\HydratorInterface;

class UserService
{
    /** @var UserGateway $userGateway */
    protected $userGateway;
    /** @var HydratorInterface $userHydrator */
    protected $userHydrator;

    /**
     * UserService constructor.
     * @param UserGateway $userGateway
     * @param HydratorInterface $userHydrator
     */
    public function __construct(UserGateway $userGateway, HydratorInterface $userHydrator)
    {
        $this->setUserGateway($userGateway);
        $this->setUserHydrator($userHydrator);
    }
    /**
     * @param string $id
     * @return User
     */
    public function findOne(string $id): User
    {
        return $this->getUserHydrator()->hydrate($this->getUserGateway()->find($id), new User());
    }
    /**
     * @param User $user
     * @return User
     */
    public function addUser(User $user): User
    {
        if (!$this->getUserGateway()->createOrUpdate($this->getUserHydrator()->extract($user))) {
            throw new \Exception('Something went wrong.', 500);
        };
        return $user;
    }
    /**
     * @return UserGateway
     */
    public function getUserGateway(): UserGateway
    {
        return $this->userGateway;
    }
    /**
     * @param UserGateway $userGateway
     * @return UserService
     */
    public function setUserGateway(UserGateway $userGateway): UserService
    {
        $this->userGateway = $userGateway;
        return $this;
    }
    /**
     * @return HydratorInterface
     */
    public function getUserHydrator(): HydratorInterface
    {
        return $this->userHydrator;
    }
    /**
     * @param HydratorInterface $userHydrator
     * @return UserService
     */
    public function setUserHydrator(HydratorInterface $userHydrator): UserService
    {
        $this->userHydrator = $userHydrator;
        return $this;
    }
}
