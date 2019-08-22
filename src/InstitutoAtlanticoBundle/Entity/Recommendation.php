<?php

namespace InstitutoAtlanticoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommendation
 *
 * @ORM\Table(name="recommendation")
 * @ORM\Entity(repositoryClass="InstitutoAtlanticoBundle\Repository\RecommendationRepository")
 */
class Recommendation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="movie", type="string", length=255)
     */
    private $movie;

    /**
     * @var float
     *
     * @ORM\Column(name="similarity", type="float")
     */
    private $similarity;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
     *
     * @param int $user
     *
     * @return Recommendation
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set movie.
     *
     * @param string $movie
     *
     * @return Recommendation
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get movie.
     *
     * @return string
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set similarity.
     *
     * @param float $similarity
     *
     * @return Recommendation
     */
    public function setSimilarity($similarity)
    {
        $this->similarity = $similarity;

        return $this;
    }

    /**
     * Get similarity.
     *
     * @return float
     */
    public function getSimilarity()
    {
        return $this->similarity;
    }
}
