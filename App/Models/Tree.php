<?php

namespace App\Models;

use App\Model;

class Tree extends Model
{
    public string $species;
    public int $fruitQuantity;
    protected const TABLE = 'trees';

    /**
     * Sets tree's species and fruit quantity
     */
    public function setTreeParams(string $species) {
        $this->species = $species;
        $this->fruitQuantity = ($species === 'Apple') ? rand(40, 50) : rand(0, 20);
    }
}