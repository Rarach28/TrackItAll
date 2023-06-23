<?php

$this->qry("CREATE TABLE `tia`.`activity` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `color` VARCHAR(6) NOT NULL , `priority` INT(5) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
$this->qry("ALTER TABLE `activity` ADD `user_id` INT(11) NOT NULL AFTER `id`;");

?>