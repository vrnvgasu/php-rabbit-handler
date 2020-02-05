<?php

namespace Vrnvgasu\PhpRabbitHandler\Jobs;

use Vrnvgasu\PhpRabbitHandler\Producer\ProducerInterface;

interface JobInterface
{
    /**
     * @param mixed ...$data
     * @return JobInterface
     */
    public static function dispatch(...$data): self;

    /**
     * @param ProducerInterface|null $producer
     * @return mixed
     */
    public function execute(ProducerInterface $producer): void;

    /**
     * @param $payload
     * @return mixed
     */
    public function setPayload($payload): self;

    /**
     * @return mixed
     */
    public function getPayload();
}
