<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Binding;

class Binding implements BindingInterface
{
    /**
     * Binding constructor.
     */
    public function __construct(protected string $routing_key = '', protected bool $nowait = false, protected array $arguments = [], protected ?int $ticket = null)
    {
    }

    public function getBindingSettings(): array
    {
        return [
            $this->routing_key,
            $this->nowait,
            $this->arguments,
            $this->ticket,
        ];
    }

    public function getRoutingKey(): string
    {
        return $this->routing_key;
    }

    public function getNowait(): bool
    {
        return $this->nowait;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return int|null
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
