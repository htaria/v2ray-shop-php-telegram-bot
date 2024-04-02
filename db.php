<?php

mysqli_query(
    $conn,
    "CREATE TABLE `{$table}` (
        `id` varchar(50) NOT NULL PRIMARY KEY,
        `step` varchar(50) NOT NULL,
        `wallet balance` varchar(50) NOT NULL,
        `servers` TEXT NOT NULL,
        `ban` varchar(50) NOT NULL
        )"
);
mysqli_query(
    $conn,
    "CREATE TABLE `{$botTable}` (
        `bot` varchar(50) NOT NULL,
        `test server` TEXT NOT NULL,
        `chanel` varchar(110) NOT NULL
        )"
);
//--------------------
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$table}` WHERE `id` = '{$from_id}' LIMIT 1"));
$id = $user['id'];
$step = $user['step'];
$walletBalance = $user['wallet balance'];
$servers = $user['servers'];
$ban = $user['ban'];
//--------------------
$botDB = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$botTable}` WHERE `bot` = 'mybot' LIMIT 1 "));
$startText = $botDB['test server'];
$campingChannel = $botDB['chanel'];
