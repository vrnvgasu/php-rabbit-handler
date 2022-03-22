<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer\Publication;

interface PublicationInterface
{
    public function getPublicationSettings(): array;

    public function getProperties(): array;

    public function getExchange(): string;

    public function getRoutingKey(): string;

    public function getMandatory(): bool;

    public function getImmediate(): bool;

    /**
     * @return mixed
     */
    public function getTicket();
}
