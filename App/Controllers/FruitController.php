<?php

namespace App\Controllers;

use App\Models\Fruit;

class FruitController
{
    /**
     * Inserts fruit into database
     */
    public static function create(int $treeId, int $fruitQuantity, string $species)
    {
        for ($i = 0; $i < $fruitQuantity; $i++) {
            $fruit = new Fruit();
            $fruit->setFruitParams($treeId, $species);
            $fruit->insert();
        }
    }

    /**
     * Returns fruit weight
     */
    public static function countWeight(string $species): string
    {
        return Fruit::weightSum($species);
    }

    /**
     * Deletes all fruits
     */
    public static function deleteAll(): void
    {
        Fruit::deleteAll();
    }
}