<?php


namespace Routing\repository;


use LogicException;
use \PDO;
use PDOException;
use Routing\model\Game;


class GameRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    //Не знаю, ловить exception или выталкивать его на уровень выше
    public function find($id)
    {
        $sql = 'SELECT * FROM game WHERE id = :id';
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetch();
        } catch (PDOException $exception) {
            echo $exception;
        }
        return null;
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM game';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function save(Game $game)
    {
        $id = $game->getId();
        if (isset($id)) {
            return $this->update($game);
        }

        $sql = "INSERT INTO game (name, description, release_date) VALUES (:name, :description, :release)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $game->getName());
        $stmt->bindParam(':description', $game->getDescription());
        $stmt->bindParam(':release', $game->getRelease());
        return $stmt->execute();
    }

    public function update(Game $game)
    {
        $id = $game->getId();
        if (!isset($id)) {
            throw new LogicException('Connot update game that does not exist in the database');
        }
        $sql = 'UPDATE game SET name=:name, description=:description, release_date=:release WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $game->getName());
        $stmt->bindParam(':description', $game->getDescription());
        $stmt->bindParam(':release', $game->getRelease());
        $stmt->bindParam(':id', $game->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}