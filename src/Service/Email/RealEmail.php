<?php
namespace Service\Email;

class RealEmail implements MailerInterface
{
    public function send($email, $subject, $body)
    {
        mail($email, $subject, $body);
    }
}