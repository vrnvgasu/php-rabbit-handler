<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Binding;

interface BindingInterface
{
    public function getBindingSettings(): array;

    public function getRoutingKey(): string;

    public function getNowait(): bool;

    public function getArguments(): array;

    /**
     * @return mixed
     */
    public function getTicket();
}
