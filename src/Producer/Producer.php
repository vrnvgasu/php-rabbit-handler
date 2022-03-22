<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer;

use Vrnvgasu\PhpRabbitHandler\AMQPHelper\AMQPHelper;
use Vrnvgasu\PhpRabbitHandler\Jobs\JobInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Vrnvgasu\PhpRabbitHandler\Producer\Publication\PublicationInterface;

class Producer implements ProducerInterface
{
    /**
     * Producer constructor.
     */
    public function __construct(protected AMQPHelper $helper, protected PublicationInterface $publication)
    {
    }

    public function execute(JobInterface $job): bool
    {
        $this->helper->getConnection()->getChannel()->basic_publish(
            $this->getMsg($job),
            $this->helper->getExchange()->getName(),
            $this->publication->getRoutingKey(),
            $this->publication->getMandatory(),
            $this->publication->getImmediate(),
            $this->publication->getTicket()
        );

        return true;
    }

    protected function getMsg(JobInterface $job): AMQPMessage
    {
        return new AMQPMessage(json_encode($job->getPayload(), JSON_THROW_ON_ERROR), $this->publication->getProperties());
    }
}
