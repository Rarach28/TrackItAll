<?php

    $this->qry(
        "CREATE TABLE `notification` (
        `id` int NOT NULL AUTO_INCREMENT,
        `title` varchar(100) NOT NULL,
        `text` varchar(150) NOT NULL,
        `type_id` int(11) NOT NULL,
        `theme` varchar(150) NOT NULL,
        `action` varchar(150) NULL,
        `timestamp` int(11) NULL,

        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");

    $this->qry(
        "CREATE TABLE `notification_type` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(100) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");

    $this->qry("INSERT INTO notification_type VALUES ('system','default')"); //system, default,


      
    $this->qry(
        "CREATE TABLE `notification_queue` (
        `id` int NOT NULL AUTO_INCREMENT,
        `notification_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `seen` int(1) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");
    
    $this->qry(
        "CREATE TABLE `organisation` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `description` text NOT NULL,
        `timestamp` int(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");

    $this->qry(
        "CREATE TABLE `organisation_user` (
        `id` int NOT NULL AUTO_INCREMENT,
        `organisation_id` int(11) NOT NULL,
        `user_id` int(11) NOT NULL,
        `status` int(2) NOT NULL,
        `token` varchar(20) NOT NULL,
        `last_change` int(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_czech_ci;");
    $this->qry("CREATE TABLE `activity_organisation` (
        `id` int NOT NULL AUTO_INCREMENT,
        `activity_id` int(11) NOT NULL,
        `organisation_id` int(11) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
/*

        zakladatel organizace ma automaticky zaznam se statusem 6

        status = [
            1 = pending/intited
            2 = invite_declined/expired
            3 = blocked

            4 = member
            5 = manager //muze pozivat a odebirat cleny, krom ownera
            6 = owner //muze mazat, a pridavat cleny a role


        ]

        token = aktivacni randomString
        

        kdyz owner nekoho pozve tak se tady vytvori zaznam kde
        [
            status = 1
            token = newString ."/".user_id
            last_change = time()
        ]

        a kdyz pak ten pozvany otevre tu pozvanku (url neco jako organisation/$name/invite/$token)
        tak se chekne jestli je to casove validni, kdyz klikne na prijima a je to validni tak se status zmeni na 2 a token '';

        
*/

    // $this->qry("");

?>