<?php

namespace Vrnvgasu\PhpRabbitHandler\Queue;

class Queue implements QueueInterface
{
    public function __construct(
        /**
         * @var string
         */
        protected $name = '',
        /**
         * @var bool
         */
        protected $passive = false,
        /**
         * @var bool
         */
        protected $durable = false,
        /**
         * @var bool
         */
        protected $exclusive = false,
        /**
         * @var bool
         */
        protected $autoDelete = false,
        /**
         * @var bool
         */
        protected $nowait = false,
        /**
         * @var array
         */
        protected $arguments = [],
        /**
         * @var null|int
         */
        protected ?int $ticket = null
    )
    {
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
