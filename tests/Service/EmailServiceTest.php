<?php

namespace App\Tests\Service;

use App\Interfaces\MessageInterface;
use App\Service\EmailService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailServiceTest extends TestCase
{
    public function testSendMessage()
    {
        $mailerMock = $this->createMock(MailerInterface::class);
        $mailerMock->expects($this->once())
            ->method('send')
            ->willReturnCallback(function (Email $email) {
                $this->assertEquals($email->getTo()[0]->getAddress(), 'example@example.example');
                $this->assertEquals($email->getFrom()[0]->getAddress(), 'RecruitmentTask@HappyTeam.fakeDomain');
                $this->assertEquals($email->getSubject(), 'Potwierdzenie rejestracji');
                $this->assertEquals($email->getTextBody(), 'Dziękujemy za rejestrację w naszym serwisie.');
            }
            );

        $emailService = new EmailService($mailerMock, 'RecruitmentTask@HappyTeam.fakeDomain');

        $this->assertInstanceOf(MessageInterface::class, $emailService);
        $this->assertTrue($emailService->sendMessage('example@example.example'));
    }
}