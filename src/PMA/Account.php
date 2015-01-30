<?php

namespace PMA;

use InvalidArgumentException;

class Account
{
    protected $client_number;
    protected $user;
    protected $password;

    public function __construct($client_number, $user, $password)
    {
        $this->setClientNumber($client_number);
        $this->user = $user;
        $this->password = $password;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getClientNumber()
    {
        return $this->client_number;
    }

    public function setClientNumber($client_number)
    {
        $this->guardAgainstInvalidClientNumber($client_number);
        $this->client_number = $client_number;
    }

    private function guardAgainstInvalidClientNumber($client_number)
    {
        if ($this->isNotValidClientNumber($client_number))
            throw new  InvalidArgumentException('Invalid client number provided. Must be at most 3 numeric characters.');
    }

    private function isNotValidClientNumber($client_number)
    {
        return !$this->isValidClientNumber($client_number);
    }

    private function isValidClientNumber($client_number)
    {
        return preg_match('/^([0-9]{1,3})$/', $client_number);
    }

    public function setUser($username)
    {
        $this->guardAgainstInvalidUserName($username);
        $this->user = $username;
    }

    private function guardAgainstInvalidUserName($username)
    {
        if ($this->isNotAValidUser($username))
            throw new InvalidArgumentException('Invalid username provided.');
    }

    private function isNotAValidUser($username)
    {
        return strlen($username) > 20;
    }

    public function setPassword($password)
    {
        $this->guardAgainstInvalidPassword($password);
        $this->password = $password;
    }

    private function guardAgainstInvalidPassword($password)
    {
        if ($this->isNotAValidPassword($password))
            throw new InvalidArgumentException('Invalid password provided.');
    }

    private function isNotAValidPassword($password)
    {
        return strlen($password) > 10;
    }
}
