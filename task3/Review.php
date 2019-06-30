<?php


class Review
{
    private $game;
    private $comment;
    private $assessment;
    private $first_played;

    /**
     * Review constructor.
     * @param $game
     * @param $comment
     * @param $assessment
     * @param $first_played
     */
    public function __construct($game, $comment, $assessment, $first_played)
    {
        $this->game = $game;
        $this->comment = $comment;
        $this->assessment = $assessment;
        $this->first_played = $first_played;
    }


    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getAssessment()
    {
        return $this->assessment;
    }

    /**
     * @param mixed $assessment
     */
    public function setAssessment($assessment)
    {
        $this->assessment = $assessment;
    }

    /**
     * @return mixed
     */
    public function getFirstPlayed()
    {
        return $this->first_played;
    }

    /**
     * @param mixed $first_played
     */
    public function setFirstPlayed($first_played)
    {
        $this->first_played = $first_played;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop) : bool
    {
        return isset($this->$prop);
    }
}