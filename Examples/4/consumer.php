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
$exchange = new Exchange('direct_logs', 'direct', false, false, false);
$binding = new Binding('test_one');

$helper = new AMQPHelper($connection, $queue, $exchange, $binding);
$consume = new Consume('', false, false, false, false);

$consumer = new Consumer($helper, $consume);

$consumer->execute();
