<?php

namespace ContinuousUnit\Entity;

class User
{
    const MIN_PASS_LENGTH = 4;

    protected $id;

    protected $firstname;

    protected $lastname;

    protected $temporaryAvatar;

    private $password;

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

    public function setPassword($password)
    {
        if (strlen($password) < self::MIN_PASS_LENGTH) {
            return false;
        }

        $this->password = $this->cryptPassword($password);

        return true;
    }

    private function cryptPassword($password)
    {
        return md5($password); // Hashing is not encryption! It's just ... hashing.
    }
}
