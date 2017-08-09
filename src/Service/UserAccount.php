<?php

namespace Form;

use Repository\UserRepository;
use Service\Email\RealEmail;
use Validator\Account as AccountValidator;
use Validator\Address as AddressValidator;

class UserAccount
{
    protected $user;

    public function __construct(\User $user)
    {
        $this->user = $user;
    }

    public function register()
    {
        $validator = new AccountValidator($this->user);
        $validator->validate();
        if ($validator->hasErrors()) {
            return false;
        }
        $repository = new UserRepository();
        if ($repository->findUserByEmail($this->user->getEmail())) {
            throw new \Exception("User is already registered");
        }
        $repository->saveUser($this->user);
        mail($this->user->getEmail(), 'Thanks for registration', 'welcome to our site!');
        return true;
    }


    public function updateAddress()
    {
        $accountValidator = new AccountValidator($this->user);
        $accountValidator->validate();
        if ($accountValidator->hasErrors()) return false;

        $addressValidator = new AddressValidator($this->user);
        $addressValidator->validate();
        if ($addressValidator->hasErrors()) return false;

        $repository = new UserRepository();
        $repository->saveUser($this->user);
        return true;
    }

}