<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer\Consume;

class Consume implements ConsumeInterface
{
    /**
     * @var string
     */
    protected $consumer_tag;
    /**
     * @var bool
     */
    protected $no_local;
    /**
     * @var bool
     */
    protected $no_ack;
    /**
     * @var bool
     */
    protected $exclusive;
    /**
     * @var bool
     */
    protected $nowait;
    /**
     * @var null
     */
    protected $callback;
    /**
     * @var null|int
     */
    protected $ticket;
    /**
     * @var array
     */
    protected $arguments;

    /**
     * Consume constructor.
     * @param string $consumer_tag
     * @param bool $no_local
     * @param bool $no_ack
     * @param bool $exclusive
     * @param bool $nowait
     * @param null $callback
     * @param null $ticket
     * @param array $arguments
     */
    public function __construct(
        string $consumer_tag = '',
        bool $no_local = false,
        bool $no_ack = false,
        bool $exclusive = false,
        bool $nowait = false,
        $callback = null,
        $ticket = null,
        array $arguments = []
    ) {
        $this->consumer_tag = $consumer_tag;
        $this->no_local = $no_local;
        $this->no_ack = $no_ack;
        $this->exclusive = $exclusive;
        $this->nowait = $nowait;
        $this->callback = $callback;
        $this->ticket = $ticket;
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
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

    /**
     * @return string
     */
    public function getConsumerTag(): string
    {
        return $this->consumer_tag;
    }

    /**
     * @return bool
     */
    public function getNoLocal(): bool
    {
        return $this->no_local;
    }

    /**
     * @return bool
     */
    public function getNoAck(): bool
    {
        return $this->no_ack;
    }

    /**
     * @return bool
     */
    public function getExclusive(): bool
    {
        return $this->exclusive;
    }

    /**
     * @return bool
     */
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

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
