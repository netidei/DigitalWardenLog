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
      `reason` VARCHAR(256) NOT NULL ,
      `group` INT NOT NULL ,
      `type` INT NOT NULL ,
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
    $path = quotemeta(realpath(__DIR__ . "/data/$table.xml"));
    $query = "LOAD XML LOCAL INFILE '$path' INTO TABLE `$dbName`.`$table`;";
    $err = $connection->query($query) or die("Error on query: $query");
  }
  // Delete this script
  unlink(realpath(__DIR__ . '/init.php'));

  
  
  /*
  CREATE DATABASE `digital_journal`;
  CREATE TABLE `digital_journal`.`about` ( `field` VARCHAR(9) NOT NULL , `value` INT NOT NULL , UNIQUE (`field`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`ch_stud` ( `id` INT NOT NULL , `record` INT NOT NULL , `student` INT NOT NULL , `mark` BOOLEAN NOT NULL , `reason` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`groupp` ( `id` INT NOT NULL , `number` INT NOT NULL , `faculty` VARCHAR(255) NOT NULL , `year` DATE NOT NULL , `napravl` VARCHAR(255) NOT NULL , `stepen` VARCHAR(15) NOT NULL , `curs` INT NOT NULL , `form` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`student` ( `id` INT NOT NULL , `name` VARCHAR(180) NOT NULL , `group` INT NOT NULL , `ch_starost` BOOLEAN NOT NULL , PRIMARY KEY (`id`, `name`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`user` ( `id` INT NOT NULL , `username` VARCHAR(65) NOT NULL , `password` VARCHAR(100) NOT NULL , `role` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`record` ( `id` INT NOT NULL , `subject` INT NOT NULL , `call` INT NOT NULL , `date` DATE NOT NULL , `teacher` INT NOT NULL , `description` VARCHAR(255) NOT NULL , `prep_utv` BOOLEAN NOT NULL , `bylo` BOOLEAN NOT NULL , `reason` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`subject` ( `id` INT NOT NULL , `name` VARCHAR(60) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`calll` ( `id` INT NOT NULL , `time_begin` TIME NOT NULL , `time_end` TIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`teacher` ( `id` INT NOT NULL , `name` VARCHAR(180) NOT NULL , `ch_director` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

  CREATE TABLE `digital_journal`.`group` ( `id` INT NOT NULL , `number` INT NOT NULL , `faculty` VARCHAR(256) NOT NULL , `year` YEAR NOT NULL , `study_direction` VARCHAR(256) NOT NULL , `academic_degree` VARCHAR(30) NOT NULL , `course` INT NOT NULL , `form` BOOLEAN NOT NULL , `user` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`record` ( `id` INT NOT NULL , `subject` INT NOT NULL , `time` INT NOT NULL , `date` DATE NOT NULL , `teacher` INT NOT NULL , `description` VARCHAR(256) NOT NULL , `approved` BOOLEAN NOT NULL , `was_it` BOOLEAN NOT NULL , `reason` VARCHAR(256) NOT NULL , `group` INT NOT NULL , `type` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`subject` ( `id` INT NOT NULL , `name` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`time` ( `id` INT NOT NULL , `time_begin` TIME NOT NULL , `time_end` TIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  CREATE TABLE `digital_journal`.`teacher` ( `id` INT NOT NULL , `name` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
  */
?>