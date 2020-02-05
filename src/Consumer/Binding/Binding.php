<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Binding;

class Binding implements BindingInterface
{
    /**
     * @var string
     */
    protected $routing_key;
    /**
     * @var bool
     */
    protected $nowait;
    /**
     * @var array
     */
    protected $arguments;
    /**
     * @var null|int
     */
    protected $ticket;

    /**
     * Binding constructor.
     * @param string $routing_key
     * @param bool $nowait
     * @param array $arguments
     * @param null $ticket
     */
    public function __construct(
        string $routing_key = '',
        bool $nowait = false,
        array $arguments = [],
        $ticket = null
    ) {
        $this->routing_key = $routing_key;
        $this->nowait = $nowait;
        $this->arguments = $arguments;
        $this->ticket = $ticket;
    }

    /**
     * @return array
     */
    public function getBindingSettings(): array
    {
        return [
            $this->routing_key,
            $this->nowait,
            $this->arguments,
            $this->ticket,
        ];
    }

    /**
     * @return string
     */
    public function getRoutingKey(): string
    {
        return $this->routing_key;
    }

    /**
     * @return bool
     */
    public function getNowait(): bool
    {
        return $this->nowait;
    }

    /**
     * @return array
     */
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
