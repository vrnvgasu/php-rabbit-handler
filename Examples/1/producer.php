<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Vrnvgasu\PhpRabbitHandler\Queue\Queue;
use Vrnvgasu\PhpRabbitHandler\Exchange\Exchange;
use Vrnvgasu\PhpRabbitHandler\Connection\Connection;
use Vrnvgasu\PhpRabbitHandler\Consumer\Binding\Binding;
use Vrnvgasu\PhpRabbitHandler\AMQPHelper\AMQPHelper;
use Vrnvgasu\PhpRabbitHandler\Producer\Publication\Publication;
use Vrnvgasu\PhpRabbitHandler\Producer\Producer;
use Vrnvgasu\PhpRabbitHandler\Jobs\Job;

try {
    $connection = new Connection('localhost', 5672, 'guest', 'guest');
    $queue = new Queue('hello', false, false, false, false);
    $exchange = new Exchange();
    $binding = new Binding();

    $helper = new AMQPHelper($connection, $queue, $exchange, $binding);

    $publication = new Publication([], 'hello');

    $producer = new Producer($helper, $publication);
    $producer->execute(Job::dispatch('test1'));
} catch (\Exception $e) {
    print_r($e->getMessage());
}
