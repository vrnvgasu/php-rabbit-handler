<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Consume;

interface ConsumeInterface
{
    public function getConsumeSettings(): array;

    public function getConsumerTag(): string;

    public function getNoLocal(): bool;

    public function getNoAck(): bool;

    public function getExclusive(): bool;

    public function getNowait(): bool;

    /**
     * @return mixed
     */
    public function getCallback();

    /**
     * @return mixed
     */
    public function getTicket();

    public function getArguments(): array;
}
