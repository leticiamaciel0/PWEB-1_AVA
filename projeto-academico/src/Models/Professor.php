<?php
namespace App\Models;
use App\Interfaces\Avaliavel;

class Professor extends Pessoa implements Avaliavel {
    public function __construct(
        string $nome,
        string $email,
        public string $especialidade
    ) {
        parent::__construct($nome, $email);
    }

    public function getStatus(): string {
        return "Professor Ativo - Especialidade: {$this->especialidade}";
    }

    public function obterDados(): string {
        return "Prof. {$this->nome}";
    }
}