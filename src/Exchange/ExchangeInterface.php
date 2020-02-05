<?php

namespace Vrnvgasu\PhpRabbitHandler\Exchange;

interface ExchangeInterface
{
    /**
     * @return array
     */
    public function getExchangeSettings(): array;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return bool
     */
    public function getPassive(): bool;

    /**
     * @return bool
     */
    public function getDurable(): bool;

    /**
     * @return bool
     */
    public function getAutoDelete(): bool;

    /**
     * @return bool
     */
    public function getInternal(): bool;

    /**
     * @return bool
     */
    public function getNowait(): bool;

    /**
     * @return array
     */
    public function getArguments(): array;

    /**
     * @return mixed
     */
    public function getTicket();
}
