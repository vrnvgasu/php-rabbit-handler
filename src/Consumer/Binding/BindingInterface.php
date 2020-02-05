<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Binding;

interface BindingInterface
{
    /**
     * @return array
     */
    public function getBindingSettings(): array;

    /**
     * @return string
     */
    public function getRoutingKey(): string;

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
