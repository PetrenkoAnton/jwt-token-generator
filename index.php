<?php require __DIR__ . '/vendor/autoload.php'; // Add autoload files (required string)
(new \Dotenv\Dotenv(__DIR__))->load(); // Load .env variables (required string)

$identity = "test-identity@mail.com"; // Before generate JWT-token you must verify identity of the user.

echo (new \Crypto\AccessTokenGenerator)->generate($identity); // Display JWT-token (echo function)