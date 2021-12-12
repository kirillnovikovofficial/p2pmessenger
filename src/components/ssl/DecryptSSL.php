<?php

namespace P2pmessenger\P2pmessenger\components\ssl;

use P2pmessenger\P2pmessenger\components\ssl\exceptions\EncryptSSLException;
use P2pmessenger\P2pmessenger\core\helpers\traits\GetterTrait;

/**
 * Class DecryptSSL
 * @package P2pmessenger\P2pmessenger\components\ssl
 *
 * @property string $decryptData
 */
class DecryptSSL
{
    private const METHOD = 'AES256';

    private ?string $decryptData = null;

    private ?EncryptSSL $encryptSSL = null;
    private ?string $privateKey = null;

    use GetterTrait;

    public function __construct(EncryptSSL $encryptSSL, string $privateKey)
    {
        $this->encryptSSL = $encryptSSL;
        $this->privateKey = $privateKey;
        $this->run();
    }

    public function __toString()
    {
        return $this->decryptData;
    }

    private function run(): void
    {
        $encryptSSL = $this->encryptSSL;
        if (openssl_open(
            $encryptSSL->encryptData,
            $this->decryptData,
            $encryptSSL->encryptedKey,
            $this->privateKey,
            $encryptSSL->method,
                $encryptSSL->iv
            ) === false)
        {
            throw new EncryptSSLException('Failed to decrypt message.');
        }
    }
}