<?php

namespace MailBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmailConsumer
{
    /** @var ContainerInterface $container */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param AMQPMessage $msg
     * @return bool
     */
    public function execute(AMQPMessage $msg)
    {
        return $this->processMessage($msg);
    }

    /**
     * @param AMQPMessage $msg
     * @return int
     */
    public function processMessage(AMQPMessage $msg)
    {
        $message = unserialize($msg->getBody());
        $transport = $this->getTransport();
        $transport->send($message);
        $transport->stop();

        return ConsumerInterface::MSG_ACK;
    }

    /** @return \Swift_Transport  */
    protected function getTransport()
    {
        /** @var \Swift_Transport $swiftTransport */
        $swiftTransport = $this->container->get('swiftmailer.transport.real');

        if (!$swiftTransport->isStarted()) {
            $swiftTransport->start();
        }

        return $swiftTransport;
    }
}