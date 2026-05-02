<?php
require_once 'src/Traits/Loggable.php';
require_once 'src/Interfaces/Avaliavel.php';
require_once 'src/Models/Pessoa.php';
require_once 'src/Models/Aluno.php';
require_once 'src/Models/Professor.php';
require_once 'src/Services/Turma.php';
require_once 'src/Services/RelatorioService.php';

use App\Models\Aluno;
use App\Services\Turma;
use App\Services\RelatorioService;

// Criando instâncias
$aluno1 = new Aluno("Marcos", "marcos@email.com", "ABC-001");
$aluno1->adicionarNota(8.5);
$aluno1->adicionarNota(7.5);

$aluno2 = new Aluno("Julia", "julia@email.com", "ABC-002");
$aluno2->adicionarNota(6.0);
$aluno2->adicionarNota(5.5);

// Gerenciando Turma
$turma = new Turma("Programação PHP");
$turma->adicionarAluno($aluno1);
$turma->adicionarAluno($aluno2);

// Injeção de Dependência no Serviço de Relatório
$relatorio = new RelatorioService($turma);
$relatorio->imprimir();