<?php

namespace Vrnvgasu\PhpRabbitHandler\Jobs;

use Vrnvgasu\PhpRabbitHandler\Producer\ProducerInterface;

class Job implements JobInterface
{
    /**
     * @var string|null
     */
    protected $payload = null;

    /**
     * @param mixed ...$data
     */
    public static function dispatch(...$data): JobInterface
    {
        $job = new static();

        $job->handle(...$data);

        return $job;
    }

    /**
     * @param $data
     */
    protected function handle($data)
    {
        $this->setPayload($data);
    }

    public function execute(ProducerInterface $producer): void
    {
        $producer->execute($this);
    }

    /**
     * @param $payload
     */
    public function setPayload($payload): JobInterface
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
