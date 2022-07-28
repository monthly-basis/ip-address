CREATE TABLE `banned_first_four_segments` (
    `first_four_segments` varchar(19) NOT NULL,
    `created` datetime NOT NULL,
    UNIQUE KEY `first_four_segments` (`first_four_segments`)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
