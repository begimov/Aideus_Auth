<?php

namespace Aideus\Mailer;

class Message
{
    private $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTo($email)
    {
        $this->mailer->addAddress($email);
    }

    public function setSubject($subj)
    {
        $this->mailer->Subject = $subj;
    }

    public function setBody($body)
    {
        $this->mailer->Body = $body;
    }
}
