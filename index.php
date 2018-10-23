<?php require __DIR__ . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$cryptoService = new \Crypto\CryptoService();

echo $cryptoService->generateJWTToken('test-identity@mail.com');