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
    $queue = new Queue();
    $exchange = new Exchange('topic_logs', 'topic', false, false, false);
    $binding = new Binding();

    $helper = new AMQPHelper($connection, $queue, $exchange, $binding);

    $publication = new Publication([], 'anonymous.warning');

    $producer = new Producer($helper, $publication);
    $producer->execute(Job::dispatch('test5'));
} catch (\Exception $e) {
    print_r($e->getMessage());
}
