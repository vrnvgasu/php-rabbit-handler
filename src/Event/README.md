## Event
Call jobs.

### Using

#### Execute
At the first you need to transfer data for preparation to `execute`.
```php
use ATC\Event\TestEvent;

TestEvent::execute($param1, $param2, $param3);
```
#### Class declaration
TestEvent must extends from `BaseEvent`
```php
class TestEvent extends BaseEvent
{
    //
}
```

#### Handling
In TestEvent you must to declare method `handle` with params which you pass in `execute`
```php
    protected static function handle($param1, $param2, $param3)
    {
        // Parameters will be passed to this class automatically
        // You can do something with them and get some $data
        
        // In the same method, you need to call jobs and producers, if it is necessary
        TestJob1::dispatch($param1, $param2)->execute();
        TestJob2::dispatch($param3)->execute();
        
        (new TestProducer())->execute(TestJob2::dispatch($param1, $param3));
    }
```
