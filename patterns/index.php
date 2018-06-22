<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/22/18
 * Time: 10:19 AM
 */

ini_set('display_errors', 1);

require_once "../functions.php";
require_once "Item.php";
require_once "BaseMapper.php";
require_once "ItemMapper.php";

$dbHost = 'localhost';
$dbName = 'patterns';
$dbUser = 'asmp2';
$dbPassword = '123456';

$dsn = "mysql:host={$dbHost};dbname={$dbName}";

try {
    $pdo = new \PDO($dsn, $dbUser, $dbPassword);
} catch (\Exception $e) {
    die('Db connections problem. Error: ' . $e->getMessage());
}

$mapper = new ItemMapper($pdo);
$item = $mapper->findById(1);

custom_print_r($item);
