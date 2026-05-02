<?php
namespace App\Traits;

trait Loggable {
    public function log(string $mensagem): void {
        echo "[LOG]: $mensagem" . PHP_EOL;
    }
}