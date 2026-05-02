<?php
namespace App\Services;
use App\Models\Aluno;

class Turma {
    private array $alunos = [];

    public function __construct(public string $nomeDisciplina) {}

    public function adicionarAluno(Aluno $aluno): void {
        $this->alunos[] = $aluno;
    }

    public function getAlunos(): array {
        return $this->alunos;
    }

    public function mediaGeral(): float {
        if (empty($this->alunos)) return 0;
        $soma = array_reduce($this->alunos, fn($acc, $a) => $acc + $a->calcularMedia(), 0);
        return $soma / count($this->alunos);
    }
}