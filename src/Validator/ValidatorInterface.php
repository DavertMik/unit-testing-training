<?php

namespace Validator;

interface ValidatorInterface
{
    public function validate();

    public function getErrors();

    public function hasErrors();
}