<?php

namespace ContinuousUnitTest\Validator;

use ContinuousUnit\Validator\EmailAddress;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
   public function getFixtures()
    {
        return [
            ['toto@example.com', true],
            ['toto@toto@example.com', false],
            ['toto', false],
            ['to#$to@examaple.com', true],
            ['töto@exämple.com', true],
        ];
    }

    /**
     * @dataProvider getFixtures()
     */
    public function testAddress($address, $isValid)
    {
        $validator = new EmailAddress();

        $this->assertEquals($isValid, $validator->isValid($address));
    }
}