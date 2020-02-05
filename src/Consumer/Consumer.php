<?php

namespace Vrnvgasu\PhpRabbitHandler\Consumer;

use PhpAmqpLib\Message\AMQPMessage;
use Vrnvgasu\PhpRabbitHandler\AMQPHelper\AMQPHelper;
use Vrnvgasu\PhpRabbitHandler\Consumer\Consume\ConsumeInterface;

class Consumer implements ConsumerInterface
{
    /**
     * @var AMQPHelper
     */
    protected $helper;
    /**
     * @var ConsumeInterface
     */
    protected $consume;
    /**
     * @var null|string
     */
    protected $randomQueue = null;

    /**
     * Consumer constructor.
     * @param AMQPHelper $helper
     * @param ConsumeInterface $consume
     */
    public function __construct(
        AMQPHelper $helper,
        ConsumeInterface $consume
    ) {
        $this->helper = $helper;
        $this->consume = $consume;
    }

    /**
     * @throws \ErrorException
     */
    public function execute(): void
    {
        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $this->consume();

        while ($this->helper->getConnection()->getChannel()->is_consuming()) {
            $this->helper->getConnection()->getChannel()->wait();
        }
    }

    /**
     *
     */
    protected function consume(): void
    {
        $this->helper->getConnection()->getChannel()->basic_consume(
            $this->helper->getQueue()->getName() ?? $this->randomQueue,
            $this->consume->getConsumerTag(),
            $this->consume->getNoLocal(),
            $this->consume->getNoAck(),
            $this->consume->getExclusive(),
            $this->consume->getNowait(),
            $this->consume->getCallback() ?? function ($msg) {
                $this->callback($msg);
            },
            $this->consume->getTicket(),
            $this->consume->getArguments()
        );
    }

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
