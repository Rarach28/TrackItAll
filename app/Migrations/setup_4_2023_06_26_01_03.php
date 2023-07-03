<?php

    $this->qry("CREATE TABLE `page_type` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `url_prefix` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_czech_ci NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");
    $this->qry("INSERT INTO tia.page_type (name,url_prefix) VALUES
        ('activity','activity'),
        ('notification','notification'),
        ('tracker','tracker');
    ");
    $this->qry("CREATE TABLE `url` (
        `id` int NOT NULL AUTO_INCREMENT,
        `page_type_id` int(11) NOT NULL,
        `ident` int(11) NOT NULL,
        `url` VARCHAR(150) NOT NULL,
        `default` int(1) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");
    $this->qry("CREATE TABLE `tracker` (
        `id` int NOT NULL AUTO_INCREMENT,
        `activity_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `name` varchar(100) NOT NULL,
        `from` int(11) NULL,
        `to` int(11) NULL,
        `active` int(1) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");
    // $this->qry("");

?>