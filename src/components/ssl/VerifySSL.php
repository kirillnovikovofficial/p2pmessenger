<?php

namespace P2pmessenger\P2pmessenger\components\ssl;

use P2pmessenger\P2pmessenger\components\ssl\exceptions\InvalidSSLDataException;
use P2pmessenger\P2pmessenger\core\App;

/**
 * Class VerifySSL
 * @package P2pmessenger\P2pmessenger\components\ssl
 *
 * @property string $publicKey
 * @property string $privateKey
 */
class VerifySSL
{
    private const TEST_DATA = '7a690f197b0d157b795df3ac357e4d5771cf401985af60c503af819843d9dac2';

    private ?string $publicKey = null;
    private ?string $privateKey = null;

    public function __construct(string $publicKey, string $privateKey)
    {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;

        $this->run();
    }

    private function run(): void
    {
        App::getInstance()->getLogger(new LogCategory())->debug('Start encrypt test message.');
        $encrypt = new EncryptSSL($this->publicKey, self::TEST_DATA);

        App::getInstance()->getLogger(new LogCategory())->debug('Start decrypt test message.');
        $decrypt = new DecryptSSL($encrypt, $this->privateKey);

        if ($encrypt->originalData != $decrypt) {
            throw new InvalidSSLDataException();
        }

        App::getInstance()->getLogger(new LogCategory())->debug('SSL keys was verified.');
    }
}