<?php
  // Define schema
  $commands = array(
    // Database
    "DROP DATABASE IF EXISTS `$dbName`;",
    "CREATE DATABASE `$dbName` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;",
    "USE `$dbName`",
    // User table
    'CREATE TABLE `user` (
      `id` int(11) NOT NULL,
      `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
      `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `role` int(1) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;',
    'ALTER TABLE `user`
      ADD PRIMARY KEY (`id`),
      ADD UNIQUE KEY `username` (`username`);'
  );
  foreach ($commands as $command) {
    $connection->query($command) or die("Error on query: $command");
  }
  // Load data
  $tables = array('user');
  foreach ($tables as $table) {
    $path = quotemeta(__DIR__ . '\\data\\');
    $query = "LOAD XML LOCAL INFILE '$path\\$table.xml' INTO TABLE `$dbName`.`$table`;";
    $err = $connection->query($query) or die("Error on query: $query");
  }
  // Delete this script
  unlink(__DIR__ . '\\init.php');
?>