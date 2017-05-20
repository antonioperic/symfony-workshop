<?php

namespace WorkshopBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $previousPosition;

    /**
     * @var int
     */
    private $currentPosition;

    /**
     * @var string
     */
    private $totalScore;

    /**
     * @var \DateTime
     */
    private $lastPlayedAt;

    /**
     * @var \DateTime
     */
    private $createdAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set previousPosition
     *
     * @param integer $previousPosition
     *
     * @return User
     */
    public function setPreviousPosition($previousPosition)
    {
        $this->previousPosition = $previousPosition;

        return $this;
    }

    /**
     * Get previousPosition
     *
     * @return int
     */
    public function getPreviousPosition()
    {
        return $this->previousPosition;
    }

    /**
     * Set currentPosition
     *
     * @param integer $currentPosition
     *
     * @return User
     */
    public function setCurrentPosition($currentPosition)
    {
        $this->currentPosition = $currentPosition;

        return $this;
    }

    /**
     * Get currentPosition
     *
     * @return int
     */
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }

    /**
     * Set totalScore
     *
     * @param string $totalScore
     *
     * @return User
     */
    public function setTotalScore($totalScore)
    {
        $this->totalScore = $totalScore;

        return $this;
    }

    /**
     * Get totalScore
     *
     * @return string
     */
    public function getTotalScore()
    {
        return $this->totalScore;
    }

    /**
     * Set lastPlayedAt
     *
     * @param \DateTime $lastPlayedAt
     *
     * @return User
     */
    public function setLastPlayedAt($lastPlayedAt)
    {
        $this->lastPlayedAt = $lastPlayedAt;

        return $this;
    }

    /**
     * Get lastPlayedAt
     *
     * @return \DateTime
     */
    public function getLastPlayedAt()
    {
        return $this->lastPlayedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    function __toString()
    {
        return $this->firstName . ' ' .$this->lastName;
    }
}

