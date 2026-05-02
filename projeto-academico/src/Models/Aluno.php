<?php
namespace App\Models;
use App\Interfaces\Avaliavel;

class Aluno extends Pessoa implements Avaliavel {
    private array $notas = [];

    public function __construct(
        string $nome,
        string $email,
        public readonly string $matricula
    ) {
        parent::__construct($nome, $email);
    }

    public function adicionarNota(float $nota): void {
        $this->notas[] = $nota;
    }

    public function calcularMedia(): float {
        return empty($this->notas) ? 0 : array_sum($this->notas) / count($this->notas);
    }

    public function getStatus(): string {
        return $this->calcularMedia() >= 7 ? "Aprovado" : "Recuperação";
    }

    public function obterDados(): string {
        return "Aluno: {$this->nome} (Matrícula: {$this->matricula})";
    }
}