<?php
namespace Service\Email;

interface MailerInterface
{
    public function send($email, $subject, $body);
}