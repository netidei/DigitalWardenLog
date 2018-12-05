<?php
  $alwaysUpdate = false;
  $currentVersion = 1;
  $version = 0;
  $doUpdate = true;
try {
    $check = 'SELECT `version` FROM `digital_journal`.`schema_info`';
    $data = $connection->query($check);
    if ($data) {
        if ($data->num_rows > 0) {
            $version = $data->fetch_row()[0];
        }
    }
} finally {
    $doUpdate = !($version == $currentVersion && !$alwaysUpdate);
}
if ($doUpdate) {
    // Define schema
    $commands = array(
    // Database
    "DROP DATABASE IF EXISTS `$dbName`;",
    "CREATE DATABASE `$dbName` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;",
    "USE `$dbName`",
    // Schema info
    'CREATE TABLE `schema_info` ( `version` INT NOT NULL ) ENGINE = InnoDB;',
    // User table
    'CREATE TABLE `user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
        `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `role` int(1) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE (`username`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;',
    // Page
    'CREATE TABLE `page` (
        `id` INT NOT NULL ,
        `name` VARCHAR(16) NOT NULL ,
        `title` VARCHAR(32) NOT NULL ,
        `role` INT NOT NULL ,
        `access_type` INT NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Access_list table
    'CREATE TABLE `access_list` (
        `id` INT NOT NULL ,
        `page` INT NOT NULL ,
        `role` INT NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Record table
    'CREATE TABLE `record` (
        `id` INT NOT NULL ,
        `subject` INT NOT NULL ,
        `time` INT NOT NULL ,
        `date` DATE NOT NULL ,
        `teacher` INT NOT NULL ,
        `description` VARCHAR(256) NOT NULL ,
        `approved` BOOLEAN NOT NULL ,
        `was_it` BOOLEAN NOT NULL ,
        `reason` VARCHAR(256) ,
        `type` INT NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Flow table
    'CREATE TABLE `flow` (
        `id` INT NOT NULL ,
        `group` INT NOT NULL ,
        `record` INT NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Subject table
    'CREATE TABLE `subject` (
        `id` INT NOT NULL ,
        `name` VARCHAR(256) NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Time table
    'CREATE TABLE `time` (
        `id` INT NOT NULL ,
        `time_begin` TIME NOT NULL ,
        `time_end` TIME NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Teacher table
    'CREATE TABLE `teacher` (
        `id` INT NOT NULL ,
        `name` VARCHAR(256) NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Visit table
    'CREATE TABLE `visit` (
        `id` INT NOT NULL ,
        `record` INT NOT NULL ,
        `student` INT NOT NULL ,
        `mark` BOOLEAN NOT NULL ,
        `reason` VARCHAR(256) ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Student table
    'CREATE TABLE `student` (
        `id` INT NOT NULL ,
        `name` VARCHAR(256) NOT NULL ,
        `group` INT NOT NULL ,
        PRIMARY KEY (`id`)
      ) ENGINE = InnoDB;',
    // Roadmap_event table
    'CREATE TABLE `roadmap_event` ( `id` INT NOT NULL AUTO_INCREMENT, `date` DATE NOT NULL , `title` VARCHAR(64) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`date`)) ENGINE = InnoDB;',
    // Event_subtitle table
    'CREATE TABLE `event_subtitle` ( `id` INT NOT NULL AUTO_INCREMENT, `event` INT NOT NULL , `subtitle` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;',
    "INSERT INTO `schema_info` (`version`) VALUES ($currentVersion)"
    );
    foreach ($commands as $command) {
        $connection->query($command) or die("Error on query: $command");
    }
    // Load data
    $tables = ['user', 'page', 'access_list', 'roadmap_event', 'event_subtitle', 'flow', 'record', 'student', 'subject', 'teacher', 'time', 'visit'];
    foreach ($tables as $alias => $table) {
        $path = addslashes(realpath(__DIR__ . '/data/' . (is_numeric($alias) ? $table : $alias) . '.xml'));
        $query = "LOAD XML LOCAL INFILE '$path' INTO TABLE `$dbName`.`$table`;";
        $err = $connection->query($query) or die("Error on query: $query");
    }
}
  // Delete this script
  unlink(realpath(__DIR__ . '/init.php'));
