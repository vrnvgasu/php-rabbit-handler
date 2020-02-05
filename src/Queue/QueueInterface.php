<?php

namespace Vrnvgasu\PhpRabbitHandler\Queue;

interface QueueInterface
{
    public function getQueueSettings(): array;

    public function getName(): string;

    public function getPassive(): bool;

    public function getDurable(): bool;

    public function getExclusive(): bool;

    public function getAutoDelete(): bool;

    public function getNowait(): bool;

    public function getArguments(): array;

    public function getTicket();

    public function setName(string $name):void;
}
