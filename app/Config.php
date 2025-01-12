<?php

declare(strict_types=1);

namespace App;

/**
 * @property-read ?array $config
 */
class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['POSTGRES_HOST'],
                'user' => $env['POSTGRES_USER'],
                'pass' => $env['POSTGRES_PASSWORD'],
                'database' => $env['POSTGRES_DB'],
                'driver' => $env['POSTGRES_DRIVER'] ?? 'pgsql',
            ],
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }

    public function __set(string $name, $value): void
    {
        $this->config[$name] = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->config[$name]);
    }
}
