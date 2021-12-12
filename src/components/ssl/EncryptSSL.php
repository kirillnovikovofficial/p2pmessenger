<?php

namespace P2pmessenger\P2pmessenger\components\ssl;

use P2pmessenger\P2pmessenger\components\ssl\exceptions\EncryptSSLException;
use P2pmessenger\P2pmessenger\core\App;
use P2pmessenger\P2pmessenger\core\helpers\traits\GetterTrait;

/**
 * Class EncryptSSL
 * @package P2pmessenger\P2pmessenger\components\ssl
 *
 * @property string $originalData
 * @property string $encryptData
 * @property string $encryptedKey
 * @property string $iv
 * @property string $method
 */
class EncryptSSL
{
    private ?string $originalData = null;
    private ?string $encryptData = null;
    private ?string $encryptedKey = null;
    private ?string $iv = null;
    private ?string $method = null;

    private ?string $publicKey = null;
    private ?string $data = null;

    use GetterTrait;

    public function __construct(string $publicKey, string $data, string $method = 'AES256')
    {
        $this->publicKey = $publicKey;
        $this->data = $data;
        $this->method = $method;
        $this->run();
    }

    public function __toString()
    {
        return $this->encryptData;
    }

    private function generateIV(): string
    {
        $ivLength = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivLength);

        return $iv;
    }

    private function run(): void
    {
        App::getInstance()->getLogger(new LogCategory())->debug('Start encrypt message.', ['data' => $this->data]);
        $this->iv = $this->generateIV();
        if (openssl_seal(
            $this->data,
            $this->encryptData,
            $keys,
            [$this->publicKey],
            $this->method,
            $this->iv
            ) === false
        )
        {
            throw new EncryptSSLException('Failed to encrypt message.');
        }

        $this->originalData = $this->data;
        $this->encryptedKey = $keys[0];

        App::getInstance()->getLogger(new LogCategory())->debug('Message was encrypt.', ['data' => $this->data, 'encryptData (base64)' => base64_encode($this->encryptData)]);
    }
}