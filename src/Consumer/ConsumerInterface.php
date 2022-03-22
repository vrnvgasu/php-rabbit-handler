<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer;

use PhpAmqpLib\Message\AMQPMessage;

interface ConsumerInterface
{
    /**
     *
     */
    public function execute(): void;

    public function callback(AMQPMessage $msg): void;

    public function startConsumer(): void;
}
