<?php


class Game
{
    private $title;
    private $description;
    private $developer;
    private $genres;
    private $release_date;

    /**
     * Game constructor.
     * @param $title
     * @param $description
     * @param $developer
     * @param $genres
     * @param $release_date
     */
    public function __construct($title, $description, $developer, $genres, $release_date)
    {
        $this->title = $title;
        $this->description = $description;
        $this->developer = $developer;
        $this->genres = $genres;
        $this->release_date = $release_date;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @param mixed $developer
     */
    public function setDeveloper($developer)
    {
        $this->developer = $developer;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * @param mixed $release_date
     */
    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop) : bool
    {
        return isset($this->$prop);
    }

    public function __toString()
    {
        return $this->title . " " . $this->developer->getName() . " " . $this->release_date;
    }
}