<?php

namespace InstitutoAtlanticoBundle\Command;

use InstitutoAtlanticoBundle\Entity\Recommendation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class IaRecommendationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ia:recommendation')
            ->setDescription('A command that listener the RabbitMQ and update the recommendations according to users rating the movies');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {        
        $connection = new AMQPStreamConnection('localhost', 5672, 'mquser', 'mqpass');
        $channel = $connection->channel();

        $channel->queue_declare('recommendation_queue', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            $container = $this->getContainer();
            $users = $this->getAllUsers($container);
            $recommendations = $this->getRecommendations($container, $users);
            $result = $this->saveRecommendations($container, $recommendations);
            echo $result." rows updated on recommendation table (".$msg->body.")\n";
        };

        $channel->basic_consume('recommendation_queue', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function getAllUsers($container)
    {
        return $container->get('user_service')->getAllUsers();
    }

    private function getRecommendations($container, $users)
    {
        $recommendations = [];
        foreach($users as $user) {
            $recommendations[$user->getId()] = $container->get('recommendation_service')->generateRecommendationsByUser($user->getId());
        }
        return $recommendations;
    }

    private function saveRecommendations($container, $recommendations)
    {
        $em = $container->get('doctrine')->getEntityManager();
        $connection = $em->getConnection();
        $platform   = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL('recommendation', false));
        $repository = $em->getRepository('InstitutoAtlanticoBundle:Recommendation');
        $counter = 0;

        foreach($recommendations as $key => $value) {
            foreach($value as $val) {
                $recommendation = new Recommendation();
                $recommendation->setUser($key);
                $recommendation->setMovie($val['movie']);
                $recommendation->setSimilarity($val['similarity']);
                $repository->persist($recommendation);
                $counter++;
            }
        }
        $repository->flush();

        return $counter;
    }

}
