<?php
$dsn = 'mysql:host=db;dbname=hereswhatsontap;';
$username = 'hereswhatsontap';
$password = 'hereswhatsontap!';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$dbh = new PDO($dsn, $username, $password, $options);

$sql = "SELECT * from user";
$statement = $dbh->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(2);
print_r($users);
?>