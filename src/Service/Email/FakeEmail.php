<?php

namespace Service\Email;

class FakeEmail implements MailerInterface
{

    public static $emails = [];

    public function send($email, $subject, $body)
    {
        self::$emails[] = [$email, $subject, $body];
    }
}