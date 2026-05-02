<?php
namespace App\Services;

class RelatorioService {
    // Injeção de Dependência da classe Turma
    public function __construct(private Turma $turma) {}

    public function imprimir(): void {
        echo "RELATÓRIO DA TURMA: " . $this->turma->nomeDisciplina . PHP_EOL;
        echo "------------------------------------------" . PHP_EOL;
        foreach ($this->turma->getAlunos() as $aluno) {
            echo "{$aluno->obterDados()} | Status: {$aluno->getStatus()}" . PHP_EOL;
        }
        echo "------------------------------------------" . PHP_EOL;
        echo "Média Final da Turma: " . $this->turma->mediaGeral() . PHP_EOL;
    }
}