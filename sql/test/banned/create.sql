CREATE TABLE `banned` (
    `banned_id` int(10) unsigned auto_increment,
    `ip_address` varchar(45) NOT NULL,
    `user_id` int(10) unsigned DEFAULT NULL,
    `reason` varchar(255) DEFAULT NULL,
    `created` datetime DEFAULT NULL,
    PRIMARY KEY (`banned_id`),
    UNIQUE KEY `ip_address` (`ip_address`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
