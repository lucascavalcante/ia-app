<?php

namespace InstitutoAtlanticoBundle\DataFixtures;

use InstitutoAtlanticoBundle\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $titles = ['Avatar', 'Pirates of the Caribbean: At Worlds End', 'Spectre', 'The Dark Knight Rises', 'John Carter',
            'Spider-Man 3', 'Tangled', 'Avengers: Age of Ultron', 'Harry Potter and the Half-Blood Prince',
            'Batman v Superman: Dawn of Justice', 'Superman Returns', 'Quantum of Solace',
            'Pirates of the Caribbean: Dead Mans Chest', 'The Lone Ranger', 'Man of Steel',
            'The Chronicles of Narnia: Prince Caspian', 'The Avengers', 'Pirates of the Caribbean: On Stranger Tides',
            'Men in Black 3', 'The Hobbit: The Battle of the Five Armies', 'The Amazing Spider-Man', 'Robin Hood',
            'The Hobbit: The Desolation of Smaug', 'The Golden Compass', 'King Kong', 'Titanic', 'Captain America: Civil War',
            'Battleship', 'Jurassic World', 'Skyfall', 'Spider-Man 2', 'Iron Man 3', 'Alice in Wonderland',
            'X-Men: The Last Stand', 'Monsters University', 'Transformers: Revenge of the Fallen',
            'Transformers: Age of Extinction', 'Oz: The Great and Powerful', 'The Amazing Spider-Man 2',
            'TRON: Legacy', 'Cars 2', 'Green Lantern', 'Toy Story 3', 'Terminator Salvation', 'Furious 7', 'World War Z',
            'X-Men: Days of Future Past', 'Star Trek Into Darkness', 'Jack the Giant Slayer', 'The Great Gatsby',
            'Prince of Persia: The Sands of Time', 'Pacific Rim', 'Transformers: Dark of the Moon',
            'Indiana Jones and the Kingdom of the Crystal Skull', 'The Good Dinosaur', 'Brave', 'Star Trek Beyond', 'WALL·E',
            'Rush Hour 3', '2012', 'A Christmas Carol', 'Jupiter Ascending', 'The Legend of Tarzan',
            'The Chronicles of Narnia: The Lion, the Witch and the Wardrobe', 'X-Men: Apocalypse', 'The Dark Knight', 'Up',
            'Monsters vs Aliens', 'Iron Man', 'Hugo', 'Wild Wild West', 'The Mummy: Tomb of the Dragon Emperor', 'Suicide Squad',
            'Evan Almighty', 'Edge of Tomorrow', 'Waterworld', 'G.I. Joe: The Rise of Cobra', 'Inside Out', 'The Jungle Book',
            'Iron Man 2', 'Snow White and the Huntsman', 'Maleficent', 'Dawn of the Planet of the Apes', 'The Lovers', '47 Ronin',
            'Captain America: The Winter Soldier', 'Shrek Forever After', 'Tomorrowland', 'Big Hero 6', 'Wreck-It Ralph',
            'The Polar Express', 'Independence Day: Resurgence', 'How to Train Your Dragon', 'Terminator 3: Rise of the Machines',
            'Guardians of the Galaxy', 'Interstellar', 'Inception', 'The Hobbit: An Unexpected Journey', 'The Fast and the Furious',
            'The Curious Case of Benjamin Button'];

        foreach ($titles as $title) {
            $movie = new Movie();
            $movie->setTitle($title);

            $manager->persist($movie);
        }

        $manager->flush();
    }
}