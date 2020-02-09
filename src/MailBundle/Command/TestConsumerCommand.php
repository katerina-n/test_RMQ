<?php

namespace MailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestConsumerCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:test-consumer')
            ->setDescription('Hello PhpStorm');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        for ($i = 0; $i <= 5; $i++) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Some Subject')
                ->setFrom('example@gmail.com')
                ->setTo('any@whatever.com')
                ->setBody('ExampleBundle:Default:mail.html.twig', 'text/html');

            $mailer = $this->getContainer()->get('mailer');
            $mailer->send($message);
        }

//        $this->getContainer()->get('old_sound_rabbit_mq.send_email_producer')->publish('Ура, сообщенька...');
//        $this->getContainer()->get('old_sound_rabbit_mq.send_email_producer')->publish('bad');

    }
}