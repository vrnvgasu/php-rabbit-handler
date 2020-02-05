<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Vrnvgasu\PhpRabbitHandler\Queue\Queue;
use Vrnvgasu\PhpRabbitHandler\Exchange\Exchange;
use Vrnvgasu\PhpRabbitHandler\Connection\Connection;
use Vrnvgasu\PhpRabbitHandler\Consumer\Consumer;
use Vrnvgasu\PhpRabbitHandler\Consumer\Binding\Binding;
use Vrnvgasu\PhpRabbitHandler\Consumer\Consume\Consume;
use Vrnvgasu\PhpRabbitHandler\AMQPHelper\AMQPHelper;

$connection = new Connection('localhost', 5672, 'guest', 'guest');
$queue = new Queue();
$exchange = new Exchange('topic_logs', 'topic', false, false, false);

foreach (['error', 'warning'] as $mask) {
    $bindings[] = new Binding('*.' . $mask);
}
$helper = new AMQPHelper($connection, $queue, $exchange, $bindings);
$consume = new Consume('', false, false, false, false, function ($msg) {
    print_r('Message: ' . $msg->body);
});

$consumer = new Consumer($helper, $consume);

$consumer->execute();
