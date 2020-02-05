# php-rabbit-handler

composer require vrnvgasu/php-rabbit-handler

Look examples in `./Examples`.

## Connection
Create new connection.
```php
$connection = new Connection('localhost', 5672, 'guest', 'guest');
```

## Queue
Create new queue.
```php
$queue = new Queue('hello', false, false, false, false);
```
Pass '' as the first variable if you need a unique queue from rabbit.

## Exchange
Create new exchange.
```php
$exchange = new Exchange('direct_logs', 'direct', false, false, false);
```

## Bind queue and exchange
Create new binding.
```php
$binding = new Binding();
```
You can create pass routing key in your binding.
```php
$binding = new Binding('key');
```

Then you must to create helper and pass him $connection, $queue, $exchange and $binding.
```php
$helper = new AMQPHelper($connection, $queue, $exchange, $binding);
```

## Consuming
Create new consume.
```php
$consume = new Consume('', false, false,false, false);
```

You can pass callback function in Consume constructor to handle message from rabbit
```php
$consume = new Consume('', false, false, false, false, function($msg) {
    print_r('Message: ' . $msg->body);
});
```

Or you can extend your consumer class from Consumer and declare `callback` method.
```php
class TestConsumer extends Consumer
{
    /**
     * @param AMQPMessage $msg
     */
    public function callback(AMQPMessage $msg): void
    {
        print_r(' [x] Received ' . $msg->body . "\n");

        if (!$this->consume->getNoAck()) {
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        }
    }
}
```

Then you must to create consumer and pass him $helper and $consume.
```php
$consumer = new Consumer($helper, $publication);
```

Then call method `execute`.
```php
$consumer->execute();
```

## Producing
Create new publication.
```php
$publication = new Publication([], 'hello');
```
Then you must to create producer and pass him $helper and $publication.
```php
$producer = new Producer($helper, $consume);
```

You need payload for your producer.
Producer can get payload from objects which implements JobInterface.
 
You can pass your job object to Producer object
```php
$producer->execute(TestJob::dispatch($param));
```

Or you can pass producer to the method `execute`.
```php
TestJob::dispatch($param)->execute($producer);
```

## Job
Prepare payload for producer.

#### Dispatch
At the first you need to transfer data for preparation to `dispatch`.
```php
use ATC\Jobs\TestJob;

TestJob::dispatch($param1, $param2, $param3);
```
#### Class declaration
Your TestJob must extends from `Job`
```php
class TestJob extends BaseJob
{
    //
}
```

#### Handling
In TestJob you must to declare method `handle` with params which you pass in `dispatch`. `handle` will execute in `dispatch`.
```php
    protected function handle($param1, $param2, $param3)
    {
        // Parameters will be passed to this class automatically
        // You can do something with them and get some $data
        
        // In the same method, you need to transfer the payload to the method `payload` for `producer`
        $this->setPayload($data);
    }
```








