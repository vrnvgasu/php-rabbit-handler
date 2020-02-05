<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer\Publication;

class Publication implements PublicationInterface
{
    /**
     * @var string
     */
    protected $exchange;
    /**
     * @var string
     */
    protected $routing_key;
    /**
     * @var bool
     */
    protected $mandatory;
    /**
     * @var bool
     */
    protected $immediate;
    /**
     * @var null
     */
    protected $ticket;
    /**
     * @var array
     */
    protected $properties;
    /**
     * @var array
     */
    protected $arguments;

    /**
     * Publication constructor.
     * @param array $properties
     * @param string $routing_key
     * @param bool $mandatory
     * @param bool $immediate
     * @param null $ticket
     */
    public function __construct(
        array $properties = [],
        string $routing_key = '',
        bool $mandatory = false,
        bool $immediate = false,
        $ticket = null
    ) {
        $this->routing_key = $routing_key;
        $this->mandatory = $mandatory;
        $this->immediate = $immediate;
        $this->ticket = $ticket;
        $this->properties = $properties;
    }

    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @return string
     */
    public function getExchange(): string
    {
        return $this->exchange;
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
    public function getMandatory(): bool
    {
        return $this->mandatory;
    }

    /**
     * @return bool
     */
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
