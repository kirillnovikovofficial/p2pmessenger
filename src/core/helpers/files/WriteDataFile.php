<?php

namespace P2pmessenger\P2pmessenger\core\helpers\files;

use P2pmessenger\P2pmessenger\core\Exceptions\output\WriteDataFileException;

class WriteDataFile
{
    private ?string $path = null;
    private ?string $data = null;

    public function __construct(string $path, string $data)
    {
        $this->path = $path;
        $this->data = $data;
        $this->run();
    }

    private function run()
    {
        if (!file_put_contents($this->path, $this->data)) {
            throw new WriteDataFileException();
        }
    }
}