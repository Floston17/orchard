<?php

namespace App\Controllers;

use App\Models\Tree;

class TreeController
{
    /**
     * Fills orchard by apple and pear trees
     */
    public static function fill(string $species)
    {
        $treeQuantity = $species === 'Apple' ? 10 : 15;

        for ($i = 0; $i < $treeQuantity; $i++) {
            $tree = new Tree();
            $tree->setTreeParams($species);
            $tree->insert();
            $tree->setId();
            FruitController::create($tree->id, $tree->fruitQuantity, $tree->species);
        }
    }

    /**
     * Returns apple and pear fruit quantity
     */
    public static function gather(): array
    {
        $trees = Tree::selectAll();
        $appleFruit = 0;
        $pearFruit = 0;

        foreach ($trees as $tree) {
            if ($tree->species === 'Apple') {
                $appleFruit = $appleFruit + $tree->fruitQuantity;
            } else {
                $pearFruit = $pearFruit + $tree->fruitQuantity;
            }
        }

        return [$appleFruit, $pearFruit];
    }

    /**
     * Deletes all trees
     */
    public static function deleteAll()
    {
        Tree::deleteAll();
    }
}