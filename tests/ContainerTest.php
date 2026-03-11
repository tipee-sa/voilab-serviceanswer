<?php

declare(strict_types=1);

namespace Voilab\Serviceanswer\Test;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Voilab\Serviceanswer\Answer;
use Voilab\Serviceanswer\Container;

class ContainerTest extends TestCase
{
    #[Test]
    public function answerFactoryReturnsNewInstanceEachTime(): void
    {
        $container = new Container([]);

        $answer1 = $container['answer'];
        $answer2 = $container['answer'];

        self::assertInstanceOf(Answer::class, $answer1);
        self::assertInstanceOf(Answer::class, $answer2);
        self::assertNotSame($answer1, $answer2);
    }

    #[Test]
    public function answerFactoryReturnsSuccessfulAnswer(): void
    {
        $container = new Container([]);

        $answer = $container['answer'];
        self::assertInstanceOf(Answer::class, $answer);

        self::assertTrue($answer->isSuccess());
    }

    #[Test]
    public function errorFactoryReturnsFailedAnswer(): void
    {
        $container = new Container([]);

        $error = $container['error'];
        self::assertInstanceOf(Answer::class, $error);

        self::assertFalse($error->isSuccess());
    }

    #[Test]
    public function configMergesWithDefaults(): void
    {
        $container = new Container([
            'custom' => 'value',
        ]);

        /** @var array{wording: array{devMessagePrefix: string}, custom: string} $config */
        $config = $container['config'];

        self::assertSame('Technical message: ', $config['wording']['devMessagePrefix']);
        self::assertSame('value', $config['custom']);
    }

    #[Test]
    public function configDefaultsCanBeOverridden(): void
    {
        $container = new Container([
            'wording' => [
                'devMessagePrefix' => 'Custom: ',
            ],
        ]);

        /** @var array{wording: array{devMessagePrefix: string}} $config */
        $config = $container['config'];

        self::assertSame('Custom: ', $config['wording']['devMessagePrefix']);
    }
}
