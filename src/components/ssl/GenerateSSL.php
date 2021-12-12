<?php

namespace P2pmessenger\P2pmessenger\components\ssl;

use P2pmessenger\P2pmessenger\components\ssl\exceptions\GeneratePrivateKeyException;
use P2pmessenger\P2pmessenger\components\ssl\exceptions\GeneratePublicKeyException;
use P2pmessenger\P2pmessenger\components\ssl\exceptions\InvalidSSLDataException;
use P2pmessenger\P2pmessenger\core\App;
use P2pmessenger\P2pmessenger\core\helpers\files\WriteDataFile;
use P2pmessenger\P2pmessenger\core\helpers\traits\GetterTrait;

/**
 * Class GenerateSSL
 * @package P2pmessenger\P2pmessenger\components\ssl
 *
 * @property string $publicKey
 * @property string $privateKey
 */
class GenerateSSL
{
    private const PRIVATE_KEY_CONFIG = [
        'digest_alg' => 'sha512',
        'private_key_bits' => 4096,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ];

    private ?string $publicKey = null;
    private ?string $privateKey = null;

    private ?\OpenSSLAsymmetricKey $originalPrivateKey = null;

    use GetterTrait;

    public function __construct()
    {
        $this->run();
    }

    private function generatePrivateKey(array $config = []): void
    {
        $this->originalPrivateKey = openssl_pkey_new(array_merge($config, self::PRIVATE_KEY_CONFIG));
        if (openssl_pkey_export($this->originalPrivateKey, $this->privateKey) === false) {
            throw new GeneratePrivateKeyException();
        }

        new WriteDataFile(App::getInstance()->router->createRuntimeRoute('ssl/private.key'), $this->privateKey);
    }

    private function generatePublicKey(): void
    {
        $this->publicKey = openssl_pkey_get_details($this->originalPrivateKey)['key'] ?? false;
        if (!$this->publicKey) {
            throw new GeneratePublicKeyException();
        }

        new WriteDataFile(App::getInstance()->router->createRuntimeRoute('ssl/public.key'), $this->publicKey);
    }

    private function run(): void
    {
        try {
            $this->publicKey = file_get_contents(App::getInstance()->router->createRuntimeRoute('ssl/public.key'));
            $this->privateKey = file_get_contents(App::getInstance()->router->createRuntimeRoute('ssl/private.key'));

            new VerifySSL($this->publicKey, $this->privateKey);
        } catch (\Throwable $e) {
            echo $e->getMessage() . PHP_EOL; //TODO: use LoggerInterface
            $this->generatePrivateKey();
            $this->generatePublicKey();
        }
    }
}