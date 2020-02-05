<?php

namespace Vrnvgasu\PhpRabbitHandler\Exchange;

class Exchange implements ExchangeInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var bool
     */
    protected $passive = false;
    /**
     * @var bool
     */
    protected $durable = true;
    /**
     * @var bool
     */
    protected $autoDelete = false;
    /**
     * @var bool
     */
    protected $internal = false;
    /**
     * @var bool
     */
    protected $nowait = false;
    /**
     * @var array
     */
    protected $arguments = [];
    /**
     * @var null|int
     */
    protected $ticket = null;

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
     * @param null $ticket
     */
    public function __construct(
        $name = '',
        $type = '',
        $passive = false,
        $durable = true,
        $autoDelete = false,
        $internal = false,
        $nowait = false,
        $arguments = [],
        $ticket = null
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->passive = $passive;
        $this->durable = $durable;
        $this->autoDelete = $autoDelete;
        $this->internal = $internal;
        $this->nowait = $nowait;
        $this->arguments = $arguments;
        $this->ticket = $ticket;
    }

    /**
     * @return array
     */
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function getPassive(): bool
    {
        return $this->passive;
    }

    /**
     * @return bool
     */
    public function getDurable(): bool
    {
        return $this->durable;
    }

    /**
     * @return bool
     */
    public function getAutoDelete(): bool
    {
        return $this->autoDelete;
    }

    /**
     * @return bool
     */
    public function getInternal(): bool
    {
        return $this->internal;
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
