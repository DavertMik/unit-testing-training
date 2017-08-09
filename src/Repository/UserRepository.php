<?php

namespace Repository;

class UserRepository
{
    const FILE = __DIR__ . "/data.storage";

    protected $users;

    public function __construct()
    {
        $this->loadFromStorage();
    }

    protected function loadFromStorage()
    {
        if (!file_exists(self::FILE)) {
            throw new \Exception('This is no such user');
        }
        $this->users = json_decode(file_get_contents(self::FILE), true);
        if (!$this->users) $this->users = [];
    }

    public function saveToStorage()
    {
        return file_put_contents(self::FILE, json_encode($this->users));
    }
    
    public function findUserByEmail($email)
    {
        foreach ($this->users as $userData) {
            if (isset($userData['email'])) {
                if ($userData['email'] === $email) {
                    return $userData;
                }
            }
        }
    }
    
    public function find($id)
    {
        if (!isset($this->users[$id])) {
            throw new \Exception("User $id not found");
        }
        return $this->users[$id];
    }
    public function saveUser(\User $user)
    {
        $id = $user->getId();
        if (!$id) {
            $id = uniqid();
        }
        $this->users[$id] = $user->toArray();
        return $this->saveToStorage();
    }
}