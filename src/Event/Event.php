<?php

namespace Vrnvgasu\PhpRabbitHandler\Event;

abstract class Event implements EventInterface
{
    /**
     * @param mixed ...$data
     */
    public static function dispatch(...$data)
    {
        static::handle(...$data);
    }

    /**
     * @param $data
     */
    protected static function handle($data)
    {
        //
    }
}
