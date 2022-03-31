<?php

namespace Vrnvgasu\PhpRabbitHandler\Jobs;

use Vrnvgasu\PhpRabbitHandler\Producer\ProducerInterface;

interface JobInterface
{
    /**
     * @param mixed ...$data
     */
    public static function dispatch(...$data): self;

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
