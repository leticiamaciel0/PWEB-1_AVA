<?php
namespace App\Models;
use App\Traits\Loggable;

abstract class Pessoa {
    use Loggable;

    public function __construct(
        public string $nome,
        public string $email
    ) {}

    abstract public function obterDados(): string;
}