<?php

namespace WorkshopBundle\Handler;

use Doctrine\ORM\EntityManager;
use WorkshopBundle\Entity\User;
use WorkshopBundle\Repository\ScoreRepository;
use WorkshopBundle\Repository\UserRepository;

class TableRankingHandler
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ScoreRepository
     */
    private $scoreRepository;

    /**
     * TableRankingHandler constructor.
     * @param EntityManager $em
     * @param UserRepository $userRepository
     * @param ScoreRepository $scoreRepository
     */
    public function __construct(EntityManager $em, UserRepository $userRepository, ScoreRepository $scoreRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
        $this->scoreRepository = $scoreRepository;
    }


    public function update()
    {
        $this->updateScores();
        $this->updateRankings();
    }

    private function updateScores()
    {
        $users = $this->userRepository->findAll();

        // update user score
        foreach ($users as $user) {
            /** @var User $user */
            $totalScore = $this->scoreRepository->findTotalScoreByUser($user);
            $user->setTotalScore($totalScore['totalPoints']);

            $this->em->flush();
        }
    }

    private function updateRankings()
    {

        $users = $this->userRepository->findAll();
        foreach ($users as $key => $user) {
            /** @var User $user */
            $user->setPreviousPosition($user->getCurrentPosition());
            $user->setCurrentPosition($key + 1);

            $this->em->flush();
        }
    }
}