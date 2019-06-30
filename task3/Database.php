<?php

require_once 'Developer.php';
require_once 'Game.php';
require_once 'Genre.php';
require_once 'Review.php';

class Database
{
    private $developers;
    private $genres;
    private $games;
    private $reviews;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->developers = [
            new Developer("Ubisoft"),
            new Developer("Activision"),
            new Developer("CD Project RED"),
            new Developer("Piranha Bytes"),
            new Developer("Arcane Studios")];
        $this->genres = [
            new Genre("RPG"),
            new Genre("Action"),
            new Genre("Shooter"),
            new Genre("Stealth Action")];
        $this->games = [
            new Game("Assassin's Creed",
                "Assassin's Creed is an action-adventure video game developed by Ubisoft Montreal and 
                published by Ubisoft.",
                $this->developers[0],
                array($this->genres[1], $this->genres[3]),
                date("2007-11-13")),

            new Game("Assassin's Creed 2",
                "Assassin's Creed II is a 2009 action-adventure video game developed by Ubisoft Montreal and 
                published by Ubisoft.",
                $this->developers[0],
                array($this->genres[1], $this->genres[3]),
                date("2009-11-13")),

            new Game("Assassin's Creed: Brotherhood",
                "Another description",
                $this->developers[0],
                array($this->genres[1], $this->genres[3]),
                date("2010-11-16")),

            new Game("Assassin's Creed: Unity",
                "Assassin's Creed Unity is an action-adventure video game developed by Ubisoft Montreal and 
                published by Ubisoft",
                $this->developers[0],
                array($this->genres[1], $this->genres[3]),
                date("2014-11-14")),

            new Game("Far Cry 3",
                "Far Cry 3 revolves around Jason Brody and his friends, American tourists who arrive on an 
                unmarked set of islands in the Pacific and are abducted by pirates who lay claim to the land, led by 
                the insane Vaas.",
                $this->developers[0],
                array($this->genres[2]),
                date("2012-11-30")),

            new Game("Far Cry Primal",
                "The game is set in the Stone Age, and revolves around the story of Takkar, who starts off as
                 an unarmed hunter and rises to become the leader of a tribe.",
                $this->developers[0],
                array($this->genres[2]),
                date("2016-03-01")),

            new Game("Call of Duty",
                "Call of Duty is a first-person shooter video game based on id Tech 3, and was released on 
                October 29, 2003.",
                $this->developers[1],
                array($this->genres[2]),
                date("2003-10-29")),

            new Game("Call of Duty 2",
                "Call of Duty 2 is a first-person shooter video game and the sequel to Call of Duty.",
                $this->developers[1],
                array($this->genres[2]),
                date("2005-10-25")),

            new Game("The Witcher 2: Assassins of Kings",
                "The Witcher 2: Assassins of Kings (Polish: Wiedźmin 2: Zabójcy królów) is an action
                role-playing hack and slash video game developed by CD Projekt Red.",
                $this->developers[2],
                array($this->genres[0],$this->genres[1]),
                date("2011-05-11")),

            new Game("The Witcher 3: Wild Hunt",
                "The Witcher 3: Wild Hunt[a] is a 2015 action role-playing game developed and published by 
                CD Projekt, based on The Witcher series of fantasy novels by Andrzej Sapkowski.",
                $this->developers[2],
                array($this->genres[0], $this->genres[1]),
                date("2015-05-19")),

            new Game("Gothic 3",
                "Gothic 3 is a fantasy-themed open world action role-playing game for Microsoft Windows from 
                the German game developer Piranha Bytes.",
                $this->developers[3],
                array($this->genres[0]),
                date("2006-10-13")),

            new Game("Risen",
                "Risen is a single-player fantasy-themed action role-playing game,[1] developed by the German
                 company Piranha Bytes and published by Deep Silver.",
                $this->developers[3],
                array($this->genres[0]),
                date("2012-10-02")),

            new Game("Risen 3: Titan Lords",
                "Risen 3: Titan Lords is an action role-playing game developed by Piranha Bytes and published
                by Deep Silver. It is the sequel to Risen 2: Dark Waters",
                $this->developers[3],
                array($this->genres[0]),
                date("2015-08-15")),

            new Game("Dishonored",
                "Dishonored is a 2012 stealth action-adventure video game developed by Arkane Studios and 
                published by Bethesda Softworks.",
                $this->developers[4],
                array($this->genres[3]),
                date("2012-10-09")),

            new Game("Prey",
                "Prey is a first-person shooter video game developed by Arkane Studios and published by
                Bethesda Softworks.",
                $this->developers[4],
                array($this->genres[2]),
                date("2017-05-05"))
            ];
        $this->reviews = [
            new Review($this->games[8],
                "OMG I LOVE THIS F*CKING GAME",
                5,
                date("2016-05-18")),

            new Review($this->games[9],
                "OMG IT'S THE WITCHER AGAIN I CANNOT PLAY",
                5,
                date("2017-06-23")),

            new Review($this->games[4],
                "Did I ever tell you what the definition of insanity is?",
                5,
                date("2013-07-01")),

            new Review($this->games[11],
                "Like the Ghotic but not the same",
                3,
                date("2013-09-16")),

            new Review($this->games[7],
                "Ha-ha I'm in love with a war - no, it's just a joke",
                2,
                date("2018-03-22"))
        ];
    }

    /**
     * @return mixed
     */
    public function getDevelopers()
    {
        return $this->developers;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @return array
     */
    public function getGamesInReview()
    {
        $reviews = $this->reviews;
        return array_column($reviews, 'game');
    }
}