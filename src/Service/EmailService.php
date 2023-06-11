<?php

namespace App\Service;

use App\Interfaces\MessageInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService implements MessageInterface
{
    private $mailer;
    private $senderEmail;

    public function __construct(MailerInterface $mailer, string $senderEmail)
    {
        $this->mailer = $mailer;
        $this->senderEmail = $senderEmail;
    }

    public function sendMessage(string $receiverEmail): bool
    {
        try {
            $email = (new Email())
                ->from($this->senderEmail)
                ->to($receiverEmail)
                ->subject('Potwierdzenie rejestracji')
                ->text('Dziękujemy za rejestrację w naszym serwisie.');

            $this->mailer->send($email);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}