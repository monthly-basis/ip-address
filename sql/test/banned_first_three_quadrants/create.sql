CREATE TABLE `banned_first_three_quadrants` (
    `first_three_quadrants` varchar(11) NOT NULL,
    `created` datetime DEFAULT NULL,
    UNIQUE KEY `first_three_quadrants` (`first_three_quadrants`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;