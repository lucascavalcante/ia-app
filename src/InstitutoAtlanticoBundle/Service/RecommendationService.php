<?php

namespace InstitutoAtlanticoBundle\Service;

class RecommendationService
{
    private $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function getRecommendationsByUser($userId)
    {
        $allRatings = $this->ratingService->getRatingsAllUsers();
        return array_slice($this->getRecommendations($allRatings, $userId), 0, 5);

    }

    private function getRecommendations($ratings, $user)
    {
        $movies = [];
        $total = [];
        $simSums = [];
        $ranks = [];
        $sim = 0;
        
        foreach($ratings as $anotherUser)
        {
            if($anotherUser['id'] != $user) {
                $sim = $this->similarityDistance($ratings, $user, $anotherUser['id']);
            }
            
            if($sim > 0) {
                foreach($ratings[$anotherUser['id']]['ratings'] as $key=>$value) {
                    if(!array_key_exists($key, $ratings[$user]['ratings'])) {
                        if(!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        $total[$key] += $ratings[$anotherUser['id']]['ratings'][$key]['rating'] * $sim;
                        
                        if(!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        $simSums[$key] += $sim;
                    }
                    $movies[$key] = $value;
                }
            }
        }

        foreach($total as $key=>$value) {
            $ranks[$key]['movie'] = $movies[$key]['movie'];
            $ranks[$key]['similarity'] = $value / $simSums[$key];
        };
        
        usort($ranks, function($a, $b) {
            return $a['similarity'] <=> $b['similarity'];
        });

        return array_reverse($ranks);
        
    }

    private function similarityDistance($ratings, $user1, $user2)
    {
        $similar = [];
        $sum = 0;
    
        foreach($ratings[$user1]['ratings'] as $key=>$value) {
            if(array_key_exists($key, $ratings[$user2]['ratings']))
                $similar[$key] = 1;
        }
        
        if(count($similar) === 0)
            return 0;

        foreach($ratings[$user1]['ratings'] as $key=>$value) {
            if(array_key_exists($key, $ratings[$user2]['ratings']))
                $sum += pow($value['rating'] - $ratings[$user2]['ratings'][$key]['rating'], 2);
        }
        
        return  1/(1 + sqrt($sum));
    }
}