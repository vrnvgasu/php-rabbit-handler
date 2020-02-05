<?php

namespace Vrnvgasu\PhpRabbitHandler\AMQPHelper;

use Vrnvgasu\PhpRabbitHandler\Connection\ConnectionInterface;
use Vrnvgasu\PhpRabbitHandler\Consumer\Binding\BindingInterface;
use Vrnvgasu\PhpRabbitHandler\Exchange\ExchangeInterface;
use Vrnvgasu\PhpRabbitHandler\Queue\QueueInterface;

class AMQPHelper
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;
    /**
     * @var QueueInterface
     */
    protected $queue;
    /**
     * @var ExchangeInterface
     */
    protected $exchange;
    /**
     * @var array
     */
    protected $bindings;

    /**
     * AMQPHelper constructor.
     * @param ConnectionInterface $connection
     * @param QueueInterface $queue
     * @param ExchangeInterface $exchange
     * @param $bindings
     */
    public function __construct(
        ConnectionInterface $connection,
        QueueInterface $queue,
        ExchangeInterface $exchange,
        $bindings
    ) {
        $this->connection = $connection;
        $this->queue = $queue;
        $this->exchange = $exchange;

        $this->bindings = is_array($bindings) ? $bindings : [$bindings];

        if ($this->exchange->getName()) {
            $this->connection->getChannel()->exchange_declare(
                $this->exchange->getName(),
                $this->exchange->getType(),
                $this->exchange->getPassive(),
                $this->exchange->getDurable(),
                $this->exchange->getAutoDelete(),
                $this->exchange->getInternal(),
                $this->exchange->getNowait(),
                $this->exchange->getArguments(),
                $this->exchange->getTicket()
            );
        }

        list($queue_name, ,) = $this->connection->getChannel()->queue_declare(
            $this->queue->getName(),
            $this->queue->getPassive(),
            $this->queue->getDurable(),
            $this->queue->getExclusive(),
            $this->queue->getAutoDelete(),
            $this->queue->getNowait(),
            $this->queue->getArguments(),
            $this->queue->getTicket()
        );

        $this->queue->setName($queue_name);

        if ($this->exchange->getName()) {
            foreach ($this->bindings as $binding) {
                $this->bind($binding);
            }
        }

        $this->registerShutdown();
    }

    /**
     * @param BindingInterface $binding
     */
    protected function bind(BindingInterface $binding): void
    {
        $this->connection->getChannel()->queue_bind(
            $this->queue->getName() ?? $this->randomQueue,
            $this->exchange->getName(),
            $binding->getRoutingKey(),
            $binding->getNowait(),
            $binding->getArguments(),
            $binding->getTicket()
        );
    }

    /**
     *
     */
    public function registerShutdown(): void
    {
        $channel = $this->connection->getChannel();
        $connection = $this->connection->getConnection();
        register_shutdown_function(function ($channel, $connection) {
            $channel->close();
            $connection->close();
        }, $channel, $connection);
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }

    /**
     * @return QueueInterface
     */
    public function getQueue(): QueueInterface
    {
        return $this->queue;
    }

    /**
     * @return ExchangeInterface
     */
    public function getExchange(): ExchangeInterface
    {
        return $this->exchange;
    }
}
