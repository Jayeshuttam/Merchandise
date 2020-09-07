<?php

require_once 'db_pdo.php';

$DB = new db_pdo();
$DB->query('insert into users (name,email,pw,user_level) values ("Jayesh","jayesh@gmail.com","12345678","employee")');

$users = $DB->querySelect('select * from users');
var_dump($users);
$DB->disconnect();
