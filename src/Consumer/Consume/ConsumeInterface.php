<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Consume;

interface ConsumeInterface
{
    /**
     * @return array
     */
    public function getConsumeSettings(): array;

    /**
     * @return string
     */
    public function getConsumerTag(): string;

    /**
     * @return bool
     */
    public function getNoLocal(): bool;

    /**
     * @return bool
     */
    public function getNoAck(): bool;

    /**
     * @return bool
     */
    public function getExclusive(): bool;

    /**
     * @return bool
     */
    public function getNowait(): bool;

    /**
     * @return mixed
     */
    public function getCallback();

    /**
     * @return mixed
     */
    public function getTicket();

    /**
     * @return array
     */
    public function getArguments(): array;
}
