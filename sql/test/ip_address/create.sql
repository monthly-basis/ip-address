CREATE TABLE `ip_address` (
    `ip_address` varchar(45) NOT NULL,
    `country_code` varchar(2) DEFAULT NULL,
    `created` datetime DEFAULT CURRENT_TIMESTAMP,
    `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`ip_address`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
