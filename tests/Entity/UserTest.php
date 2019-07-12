<?php

namespace ContinuousUnitTest\Entity;

use ContinuousUnit\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIdGetterActuallyReturnIdProperty()
    {
        $user = new User();

        $id = 10;
        $this->setProperty($user, 'id', $id);

        $this->assertEquals($id, $user->getId());
    }

    public function testFirstnameGetterActuallyReturnFirstnameProperty()
    {
        $user = new User();

        $firstname = 'Fred';
        $this->setProperty($user, 'firstname', $firstname);

        $this->assertEquals($firstname, $user->getFirstname());
    }

    public function testFirstnameSetterActuallySetFirstnameProperty()
    {
        $user = new User();

        $firstname = 'Fred';
        $this->assertSame($user, $user->setFirstname($firstname));
        $this->assertAttributeEquals($firstname, 'firstname', $user);
    }

    public function testLaststnameGetterActuallyReturnLastnameProperty()
    {
        $user = new User();

        $lastname = 'Dewinne';
        $this->setProperty($user, 'lastname', $lastname);

        $this->assertEquals($lastname, $user->getLastname());
    }
    public function testLastnameSetterActuallySetLastnameProperty()
    {
        $user = new User();
        $lastname = 'Dewinne';
        $this->assertSame($user, $user->setLastname($lastname));
        $this->assertAttributeEquals($lastname, 'lastname', $user);
    }

    public function testTemporaryAvatarGetterActuallyReturnTemporaryAvatarProperty()
    {
        $user = new User();

        $temporaryAvatar = '/tmp/toto.jpg';
        $this->setProperty($user, 'temporaryAvatar', $temporaryAvatar);

        $this->assertEquals($temporaryAvatar, $user->getTemporaryAvatar());
    }

    public function testTemporaryAvatarSetterActuallySetTemporaryAvatarProperty()
    {
        $user = new User();
        $temporaryAvatar = '/tmp/toto.jpg';
        $this->assertSame($user, $user->setTemporaryAvatar($temporaryAvatar));
        $this->assertAttributeEquals($temporaryAvatar, 'temporaryAvatar', $user);
    }

    public function testPasswordSuccessfullySet()
    {
        $user = new User();
        $password = 'nightwatch';
        $result = $user->setPassword($password);

        $this->assertTrue($result);
    }

    protected function setProperty($object, $property, $value)
    {
        $reflection = new \ReflectionObject($object);
        $reflectedProperty = $reflection->getProperty($property);
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($object, $value);
    }
}