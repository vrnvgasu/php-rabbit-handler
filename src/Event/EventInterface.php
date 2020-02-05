<?php

namespace Vrnvgasu\PhpRabbitHandler\Event;

interface EventInterface
{
    /**
     * @param mixed ...$data
     */
    public static function dispatch(...$data);
}
