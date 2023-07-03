<?php

    $this->qry("CREATE TABLE `activity` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `priority` int NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
    $this->qry("CREATE TABLE `activity_user` (
      `id` int NOT NULL AUTO_INCREMENT,
      `activity_id` int(11) NOT NULL,
      `user_id` int(11) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
    $this->qry("CREATE TABLE `allLog` (
        `id` int NOT NULL AUTO_INCREMENT,
        `timestamp` int NOT NULL,
        `key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_czech_ci NOT NULL,
        `val` text CHARACTER SET utf8mb3 COLLATE utf8mb3_czech_ci NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");
    $this->qry("CREATE TABLE `auth_logins` (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `firstname` varchar(255) NOT NULL,
        `lastname` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL,
        `ip_address` varchar(255) NOT NULL,
        `date` datetime NOT NULL,
        `successfull` int NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=MyISAM AUTO_INCREMENT=266 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
    $this->qry("CREATE TABLE `auth_tokens` (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `selector` varchar(255) NOT NULL,
        `hashedvalidator` varchar(255) NOT NULL,
        `expires` datetime NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
    $this->qry("CREATE TABLE `user_roles` (
        `id` int NOT NULL AUTO_INCREMENT,
        `role_name` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
    $this->qry("CREATE TABLE `users` (
        `id` int NOT NULL AUTO_INCREMENT,
        `firstname` varchar(50) NOT NULL,
        `lastname` varchar(50) NOT NULL,
        `email` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        `reset_token` varchar(250) NOT NULL,
        `reset_expire` datetime DEFAULT NULL,
        `activated` tinyint(1) NOT NULL,
        `activate_token` varchar(250) DEFAULT NULL,
        `activate_expire` varchar(250) DEFAULT NULL,
        `role` int NOT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `deleted_at` datetime DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
   
        $this->qry("INSERT INTO activity (name,color,priority) VALUES
        ('WORK','#0040ff',100),
        ('School','#ffc800',5);");
        $this->qry("INSERT INTO activity_user (activity_id,user_id) VALUES
        (1,1),(2,1);");
        $this->qry("INSERT INTO users (firstname,lastname,email,password,reset_token,reset_expire,activated,activate_token,activate_expire,`role`,created_at,updated_at,deleted_at) VALUES
        ('Tomáš','Hotárek','tom@hot.cz','\$argon2id\$v=19\$m=65536,t=4,p=1\$U3lzOXlqS05SbkZWekRUaQ\$zStIdsZ1J9EpAhKMUOB642VqnsHb0pmxMYp8/JFsOlA','',NULL,1,NULL,NULL,1,'2023-04-06 23:43:16','2023-04-06 23:43:16',NULL),
        ('Super','User','super@user.cz','\$argon2id\$v=19\$m=65536,t=4,p=1\$U3lzOXlqS05SbkZWekRUaQ\$zStIdsZ1J9EpAhKMUOB642VqnsHb0pmxMYp8/JFsOlA','',NULL,1,NULL,NULL,1,'2023-04-06 23:43:16','2023-04-06 23:43:16',NULL),
        ('Admin','User','admin@user.cz','\$argon2id\$v=19\$m=65536,t=4,p=1\$U3lzOXlqS05SbkZWekRUaQ\$zStIdsZ1J9EpAhKMUOB642VqnsHb0pmxMYp8/JFsOlA','',NULL,1,NULL,NULL,2,'2023-04-06 23:43:16','2023-04-06 23:43:16',NULL),
        ('End','User','end@user.cz','\$argon2id\$v=19\$m=65536,t=4,p=1\$U3lzOXlqS05SbkZWekRUaQ\$zStIdsZ1J9EpAhKMUOB642VqnsHb0pmxMYp8/JFsOlA','',NULL,1,NULL,NULL,3,'2023-04-06 23:43:16','2023-04-06 23:43:16',NULL);
    ");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
    // $this->qry("");
?>