<?php

namespace P2pmessenger\P2pmessenger\core\helpers;

use P2pmessenger\P2pmessenger\core\config\Router as RouterConfig;

final class Router extends Singleton
{
    private static ?self $instance = null;

    private ?string $basedir = null;

    public static function getInstance(RouterConfig $config): self
    {
        if (self::$instance === null) {
            self::$instance = new static($config);
        }

        return self::$instance;
    }

    protected function __construct(RouterConfig $config)
    {
        parent::__construct($config);
        $this->basedir = $config->getBasedir() ?? __DIR__ . '/../../../';

        $this->checkFolder($config->getFolders() ?? []);
    }

    private function checkFolder(array $folders, string $path = ''): void
    {
        foreach ($folders as $key => $folder) {
            if (is_string($folder)) {
                $this->createDir($path . $folder);
            }
            if (is_array($folder)) {
                $this->createDir($path . $key);
                $this->checkFolder($folder, "{$path}{$key}/");
            }
        }
    }

    private function createDir(string $path): void
    {
        @mkdir('runtime/' . $path);
    }

    public function createRoute(string $path):  string
    {
        return $this->basedir . '/src/' . $path;
    }

    public function createRuntimeRoute(string $path):  string
    {
        return "{$this->basedir}/runtime/{$path}";
    }
}