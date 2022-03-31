<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Consume;

class Consume implements ConsumeInterface
{
    /**
     * @var null
     */
    protected $callback;

    /**
     * Consume constructor.
     * @param null $callback
     */
    public function __construct(
        protected string $consumer_tag = '',
        protected bool $no_local = false,
        protected bool $no_ack = false,
        protected bool $exclusive = false,
        protected bool $nowait = false,
        $callback = null,
        protected ?int $ticket = null,
        protected array $arguments = []
    ) {
        $this->callback = $callback;
    }

    public function getConsumeSettings(): array
    {
        return [
            $this->consumer_tag,
            $this->no_local,
            $this->no_ack,
            $this->exclusive,
            $this->nowait,
            $this->callback,
            $this->ticket,
            $this->arguments,
        ];
    }

    public function getConsumerTag(): string
    {
        return $this->consumer_tag;
    }

    public function getNoLocal(): bool
    {
        return $this->no_local;
    }

    public function getNoAck(): bool
    {
        return $this->no_ack;
    }

    public function getExclusive(): bool
    {
        return $this->exclusive;
    }

    public function getNowait(): bool
    {
        return $this->nowait;
    }

    /**
     * @return null
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return int|null
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
