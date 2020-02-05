<?php
require_once __DIR__ . '/vendor/autoload.php';

use Vrnvgasu\PhpRabbitHandler\Queue\Queue;
use Vrnvgasu\PhpRabbitHandler\Exchange\Exchange;
use Vrnvgasu\PhpRabbitHandler\Connection\Connection;
use Vrnvgasu\PhpRabbitHandler\Consumer\Consumer;
use Vrnvgasu\PhpRabbitHandler\Consumer\Binding\Binding;
use Vrnvgasu\PhpRabbitHandler\Consumer\Consume\Consume;
use Vrnvgasu\PhpRabbitHandler\AMQPHelper\AMQPHelper;

$connection = new Connection('homestead.test', 5672, 'homestead', 'homestead');
//$connection = new Connection('localhost', 5672, 'guest', 'guest');
$queue = new Queue('', false, false, true, false);
$exchange = new Exchange('logs', 'fanout', false, false, false);

$binding = new Binding();

$helper = new AMQPHelper($connection, $queue, $exchange, $binding);
$consume = new Consume('', false, false,false, false);

$consumer = new Consumer($helper, $consume);

$consumer->execute();
