<?php

namespace Vrnvgasu\PhpRabbitHandler\Exchange;

class Exchange implements ExchangeInterface
{
    /**
     * Exchange constructor.
     * @param string $name
     * @param string $type
     * @param bool $passive
     * @param bool $durable
     * @param bool $autoDelete
     * @param bool $internal
     * @param bool $nowait
     * @param array $arguments
     * @param int|null $ticket
     */
    public function __construct(protected $name = '', protected $type = '', protected $passive = false, protected $durable = true, protected $autoDelete = false, protected $internal = false, protected $nowait = false, protected $arguments = [], protected ?int $ticket = null)
    {
    }

    public function getExchangeSettings(): array
    {
        return [
            $this->name,
            $this->type,
            $this->passive,
            $this->durable,
            $this->autoDelete,
            $this->internal,
            $this->nowait,
            $this->arguments,
            $this->ticket,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPassive(): bool
    {
        return $this->passive;
    }

    public function getDurable(): bool
    {
        return $this->durable;
    }

    public function getAutoDelete(): bool
    {
        return $this->autoDelete;
    }

    public function getInternal(): bool
    {
        return $this->internal;
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
