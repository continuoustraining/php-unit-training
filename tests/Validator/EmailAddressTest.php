<?php

namespace ContinuousUnitTest;

use ContinuousUnit\Validator\EmailAddress;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    public function testCheckValidEmailAddress()
    {
        $address = 'toto@example.com';

        $validator = new EmailAddress();

        $this->assertEquals(true, $validator->isValid($address));
    }

    public function testCheckEmailAddressWithMutlipleAtSign()
    {
        $address = 'toto@toto@example.com';

        $validator = new EmailAddress();

        $this->assertEquals(false, $validator->isValid($address));
    }

    public function testCheckEmailAddressWithoutDomainName()
    {
        $address = 'toto';

        $validator = new EmailAddress();

        $this->assertEquals(false, $validator->isValid($address));
    }

    public function testCheckEmailAddressContainingSpecialCharacters()
    {
        $address = 'to#$to@examaple.com';

        $validator = new EmailAddress();

        $this->assertEquals(true, $validator->isValid($address));
    }

    public function testCheckEmailAddressWithNonEnglishCharacters()
    {
        $address = 'töto@exämple.com';

        $validator = new EmailAddress();

        $this->assertEquals(true, $validator->isValid($address));
    }
}