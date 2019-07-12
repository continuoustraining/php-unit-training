<?php

namespace ContinuousUnit\Validator;

class EmailAddress
{
    public function isValid($address)
    {
        return preg_match("/^[^@]+@[^@]+$/", $address);
    }
}
