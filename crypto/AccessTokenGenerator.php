<?php

namespace Crypto;

use Virgil\CryptoImpl\VirgilAccessTokenSigner;
use Virgil\CryptoImpl\VirgilCrypto;
use Virgil\Sdk\Web\Authorization\JwtGenerator;

class AccessTokenGenerator
{
    public function generate($identity)
    {
        // API_KEY (You got this Key at Virgil Dashboard)
        $privateKeyStr = $_ENV['PRIVATE_KEY'];
        $apiKeyData = base64_decode($privateKeyStr);

        // Crypto library imports a private key into a necessary format
        $crypto = new VirgilCrypto();
        $privateKey = $crypto->importPrivateKey($apiKeyData);

        // Initialize accessTokenSigner that signs users JWTs
        $accessTokenSigner = new VirgilAccessTokenSigner();

        // Use your App Credentials you got at Virgil Dashboard:
        $appId = $_ENV['APP_ID']; // APP_ID
        $apiKeyId = $_ENV['API_KEY_ID']; // API_KEY_ID
        $ttl = $_ENV['JWT_TTL']; // JWT's lifetime

        // Setup JWT generator with necessary parameters:
        $jwtGenerator = new JwtGenerator($privateKey, $apiKeyId, $accessTokenSigner, $appId, $ttl);

        // Generate JWT for a user
        // Remember that you must provide each user with his unique JWT
        // Each JWT contains unique user's identity (in this case - Alice)
        // Identity can be any value: name, email, some id etc.
        $token = $jwtGenerator->generateToken($identity);

        // As result you get users JWT, it looks like this: "{string}.{string}.{string}"
        // You can provide users with JWT at registration or authorization steps
        // Send a JWT to client-side
        return $token->__toString();
    }
}