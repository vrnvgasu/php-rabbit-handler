<?php

namespace Vrnvgasu\PhpRabbitHandler\Producer;

use Vrnvgasu\PhpRabbitHandler\AMQPHelper\AMQPHelper;
use Vrnvgasu\PhpRabbitHandler\Jobs\JobInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Vrnvgasu\PhpRabbitHandler\Producer\Publication\PublicationInterface;

class Producer implements ProducerInterface
{
    /**
     * @var AMQPHelper
     */
    protected $helper;
    /**
     * @var PublicationInterface
     */
    protected $publication;

    /**
     * Producer constructor.
     * @param AMQPHelper $helper
     * @param PublicationInterface $publication
     */
    public function __construct(
        AMQPHelper $helper,
        PublicationInterface $publication
    ) {
        $this->helper = $helper;
        $this->publication = $publication;
    }

    /**
     * @param JobInterface $job
     * @return bool
     */
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

    /**
     * @param JobInterface $job
     * @return AMQPMessage
     */
    protected function getMsg(JobInterface $job): AMQPMessage
    {
        return new AMQPMessage(json_encode($job->getPayload()), $this->publication->getProperties());
    }
}
