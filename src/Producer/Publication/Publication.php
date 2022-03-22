<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer\Publication;

class Publication implements PublicationInterface
{
    /**
     * @var string
     */
    protected $exchange;
    /**
     * @var null
     */
    protected $ticket;
    /**
     * @var array
     */
    protected $arguments;

    /**
     * Publication constructor.
     * @param null $ticket
     */
    public function __construct(
        protected array $properties = [],
        protected string $routing_key = '',
        protected bool $mandatory = false,
        protected bool $immediate = false,
        $ticket = null
    ) {
        $this->ticket = $ticket;
    }

    public function getPublicationSettings(): array
    {
        return [
            $this->routing_key,
            $this->mandatory,
            $this->immediate,
            $this->ticket,
            $this->properties,
        ];
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getExchange(): string
    {
        return $this->exchange;
    }

    public function getRoutingKey(): string
    {
        return $this->routing_key;
    }

    public function getMandatory(): bool
    {
        return $this->mandatory;
    }

    public function getImmediate(): bool
    {
        return $this->immediate;
    }

    /**
     * @return null
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
