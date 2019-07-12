<?php

namespace ContinuousUnit\Entity;

class User
{
    protected $id;

    protected $firstname;

    protected $lastname;

    protected $temporaryAvatar;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getTemporaryAvatar()
    {
        return $this->temporaryAvatar;
    }

    public function setTemporaryAvatar($temporaryAvatar)
    {
        $this->temporaryAvatar = $temporaryAvatar;
        return $this;
    }
}