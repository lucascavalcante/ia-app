<?php

namespace InstitutoAtlanticoBundle\Helper;

use DateTime;
use DateTimeZone;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class MessageHelper
{
    public function sendMessage()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'mquser', 'mqpass');
        $channel = $connection->channel();

        $channel->queue_declare('recommendation_queue', false, false, false, false);

        $now = new DateTime('now', new DateTimeZone('America/Fortaleza'));
        $msg = new AMQPMessage($now->format('d/m/Y H:i:s'));
        $channel->basic_publish($msg, '', 'recommendation_queue');

        echo " [x] Message sent'\n";

        $channel->close();
        $connection->close();
    }
}