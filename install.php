<?php

// Include the database connection.
require_once 'database_connection.php';

// Drop the 'users' table (if it exists).
$mysqli->query("DROP TABLE IF EXISTS `users`;");

// Create the 'users' table.
$sql = "CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL COMMENT 'The username of the user.',
    `password` varchar(255) NOT NULL COMMENT 'The password of the user.',
    `name` varchar(255) NULL DEFAULT '' COMMENT 'The name of the user.',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Storage for user authentication details.';";
$mysqli->query($sql);

// Generate two test users.
$userData = [
    [
        'user1',
        password_hash('password', PASSWORD_DEFAULT),
        'User One',
    ],
    [
        'user2',
        password_hash('letmein', PASSWORD_DEFAULT),
        'User Two',
    ],
];

foreach ($userData as $id => $userDatum) {
    $stmt = $mysqli->prepare("INSERT INTO `users`(`username`, `password`, `name`) VALUES (?, ?, ?);");
    $stmt->bind_param("sss", ...$userDatum);
    $stmt->execute();
}

echo 'Authentication example table (re)created and the default users installed.' . PHP_EOL;