<?php

namespace App\Models;

use App\Model;
use core\Container;

class Fruit extends Model
{
    protected int $treeId;
    protected int $weight;
    protected const TABLE = 'fruit';

    /**
     * Sets fruit's weight and tree's id
     */
    public function setFruitParams(int $treeId, string $species): void
    {
        $this->treeId = $treeId;
        $this->weight = ($species === 'Apple') ? rand(150, 180) : rand(130, 170);
    }

    /**
     * Returns sum of weight by tree species
     */
    public static function weightSum(string $species): string
    {
        $statement = 'SELECT SUM(weight) FROM ' . static::TABLE . ' INNER JOIN trees ON ' . static::TABLE .
            '.treeId = trees.id WHERE trees.species = \'' . $species . '\'';
        return Container::get('database')->summaryQuery($statement);
    }
}