<?php

use App\Controllers\FruitController;
use App\Controllers\TreeController;
use core\Container;
use core\Database\Connection;
use core\Database\QueryBuilder;

require __DIR__ . '/autoload.php';

Container::bind('config', __DIR__ . '/core/config.php');
Container::bind('database', QueryBuilder::instance(
    Connection::make(Container::get('config')))
);

FruitController::deleteAll();
TreeController::deleteAll();

TreeController::fill('Apple');
TreeController::fill('Pear');

[$appleFruit, $pearFruit] = TreeController::gather();

$appleSumWeight = FruitController::countWeight('Apple');
$pearSumWeight = FruitController::countWeight('Pear');

echo 'Груш собрано: ' . $pearFruit . ' шт.; Общий вес: ' . $pearSumWeight . ' г.';
echo PHP_EOL;
echo 'Яблок собрано: ' . $appleFruit . ' шт.; Общий вес: ' . $appleSumWeight . ' г.';