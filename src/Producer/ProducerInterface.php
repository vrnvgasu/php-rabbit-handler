<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer;

use Vrnvgasu\PhpRabbitHandler\Jobs\JobInterface;

interface ProducerInterface
{
    /**
     * @param JobInterface $job
     * @return mixed
     */
    public function execute(JobInterface $job): bool;
}
