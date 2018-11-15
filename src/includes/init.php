<?php
  // Define schema
  $commands = array(
    // Database
    "DROP DATABASE IF EXISTS `$dbName`;",
    "CREATE DATABASE `$dbName` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;",
    "USE `$dbName`",
    // User table
    'CREATE TABLE `user` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
      `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `role` int(1) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;',
    // Roadmap_event table
    'CREATE TABLE `roadmap_event` ( `id` INT NOT NULL AUTO_INCREMENT, `date` DATE NOT NULL , `title` VARCHAR(64) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`date`)) ENGINE = InnoDB;',
    // Event_subtitle table
    'CREATE TABLE `event_subtitle` ( `id` INT NOT NULL AUTO_INCREMENT, `event` INT NOT NULL , `subtitle` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;'
  );
  foreach ($commands as $command) {
    $connection->query($command) or die("Error on query: $command");
  }
  // Load data
  $tables = array('user', 'roadmap_event', 'event_subtitle');
  foreach ($tables as $table) {
    $path = quotemeta(__DIR__ . '\\data\\\\');
    $query = "LOAD XML LOCAL INFILE '$path$table.xml' INTO TABLE `$dbName`.`$table`;";
    $err = $connection->query($query) or die("Error on query: $query");
  }
  // Delete this script
  unlink(__DIR__ . '\\init.php');
?>