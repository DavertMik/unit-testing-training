<?php

namespace Validator;

class Address
{
    protected $user;
    protected $errors = [];

    protected $requiredFields = [
        'address', 'zip', 'city', 'state'
    ];

    public function __construct(\User $user)
    {
        $this->user = $user;
    }

    public function validate()
    {
        foreach ($this->requiredFields as $field) {
            $value = $this->user->{'get' . ucfirst($field)}();
            if (!$value) $this->addError($field, "Should not be empty");
        }
    }

    protected function addError($field, $description)
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $description;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}