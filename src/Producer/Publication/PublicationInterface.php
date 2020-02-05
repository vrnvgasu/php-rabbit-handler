<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer\Publication;

interface PublicationInterface
{
    /**
     * @return array
     */
    public function getPublicationSettings(): array;

    /**
     * @return array
     */
    public function getProperties(): array;

    /**
     * @return string
     */
    public function getExchange(): string;

    /**
     * @return string
     */
    public function getRoutingKey(): string;

    /**
     * @return bool
     */
    public function getMandatory(): bool;

    /**
     * @return bool
     */
    public function getImmediate(): bool;

    /**
     * @return mixed
     */
    public function getTicket();
}
