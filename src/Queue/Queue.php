<?php

namespace Vrnvgasu\PhpRabbitHandler\Queue;

class Queue implements QueueInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var bool
     */
    protected $passive;
    /**
     * @var bool
     */
    protected $durable;
    /**
     * @var bool
     */
    protected $exclusive;
    /**
     * @var bool
     */
    protected $autoDelete;
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

    public function __construct(
        $name = '',
        $passive = false,
        $durable = false,
        $exclusive = false,
        $autoDelete = false,
        $nowait = false,
        $arguments = [],
        $ticket = null
    ) {
        $this->name = $name;
        $this->passive = $passive;
        $this->durable = $durable;
        $this->exclusive = $exclusive;
        $this->autoDelete = $autoDelete;
        $this->nowait = $nowait;
        $this->arguments = $arguments;
        $this->ticket = $ticket;
    }

    public function getQueueSettings(): array
    {
        return [
            $this->name,
            $this->passive,
            $this->durable,
            $this->exclusive,
            $this->autoDelete,
            $this->nowait,
            $this->arguments,
            $this->ticket,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassive(): bool
    {
        return $this->passive;
    }

    public function getDurable(): bool
    {
        return $this->durable;
    }

    public function getExclusive(): bool
    {
        return $this->exclusive;
    }

    public function getAutoDelete(): bool
    {
        return $this->autoDelete;
    }

    public function getNowait(): bool
    {
        return $this->nowait;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }
}
