<?php

namespace Vrnvgasu\PhpRabbitHandler\Exchange;

interface ExchangeInterface
{
    public function getExchangeSettings(): array;

    public function getName(): string;

    public function getType(): string;

    public function getPassive(): bool;

    public function getDurable(): bool;

    public function getAutoDelete(): bool;

    public function getInternal(): bool;

    public function getNowait(): bool;

    public function getArguments(): array;

    /**
     * @return mixed
     */
    public function getTicket();
}
