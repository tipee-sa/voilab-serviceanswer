<?php

declare(strict_types=1);

namespace Voilab\Serviceanswer\Test;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Voilab\Serviceanswer\Answer;
use Voilab\Serviceanswer\Container;

class AnswerTest extends TestCase
{
    private function createAnswer(?Container $container = null): Answer
    {
        $answer = ($container ?? new Container([]))['answer'];
        self::assertInstanceOf(Answer::class, $answer);

        return $answer;
    }

    #[Test]
    public function getMessageReturnsNullWhenNoMessages(): void
    {
        $answer = $this->createAnswer();

        self::assertNull($answer->getMessage());
    }

    #[Test]
    public function getMessageWithTypeReturnsMatchingMessage(): void
    {
        $answer = $this->createAnswer();
        $answer->setPublicMessage('Public info');

        self::assertSame('Public info', $answer->getMessage('public'));
    }

    #[Test]
    public function getMessageWithTypeReturnsNullWhenNotFound(): void
    {
        $answer = $this->createAnswer();
        $answer->setPublicMessage('Public info');

        self::assertNull($answer->getMessage('nonexistent'));
    }

    #[Test]
    public function getMessageFallsBackToPublicMessage(): void
    {
        $answer = $this->createAnswer();
        $answer->setPublicMessage('Public info');
        $answer->setDeveloperMessage('Dev info');

        self::assertSame('Public info', $answer->getMessage());
    }

    #[Test]
    public function getMessageFallsBackToDevMessageWithPrefix(): void
    {
        $answer = $this->createAnswer();
        $answer->setDeveloperMessage('something broke');

        self::assertSame('Technical message: something broke', $answer->getMessage());
    }

    #[Test]
    public function getMessageUsesCustomDevMessagePrefix(): void
    {
        $answer = $this->createAnswer(new Container([
            'wording' => [
                'devMessagePrefix' => 'DEBUG: ',
            ],
        ]));
        $answer->setDeveloperMessage('error details');

        self::assertSame('DEBUG: error details', $answer->getMessage());
    }

    #[Test]
    public function getMessageFallsBackToFirstAvailableMessage(): void
    {
        $answer = $this->createAnswer();
        $answer->setEmptyBodyMessage('empty body');

        self::assertSame('empty body', $answer->getMessage());
    }
}
