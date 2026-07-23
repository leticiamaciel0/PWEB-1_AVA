# Sistema de Controle de Produtos — IFCE Campus Boa Viagem
> **Projeto Avaliativo Final — Programação Web I**  
> **Estudante:** Letícia Justino Maciel  
> **Instituição:** Instituto Federal de Educação, Ciência e Tecnologia do Ceará (IFCE) - Campus Boa Viagem  

Este sistema consiste em uma plataforma profissional para gerenciamento de Produtos e Categorias. Ele integra uma interface web completa (Laravel Blade) protegida por autenticação, além de uma API REST robusta, padronizada e testada, rodando integralmente sob infraestrutura Docker via Laravel Sail.

---

## Tecnologias Utilizadas
* **PHP 8.2+**
* **Laravel 11** (Framework Base)
* **MySQL** (Banco de dados)
* **Docker & Laravel Sail** (Containerização do Ambiente)
* **Blade Engine** (Interface Web)

---

## Estrutura do Repositório
O repositório está organizado dentro do diretório principal exigido:
```text
unidade-5-projeto-final/
├── app/
├── config/
├── database/
├── public/
├── resources/
├── routes/
│   ├── api.php
│   └── web.php
├── tests/
├── Dockerfile
├── docker-compose.yml
└── README.md


omo Executar com Docker (Laravel Sail)
Para iniciar o ecossistema de containers sem a necessidade de instalar dependências locais:

Subir os containers:

Bash
./vendor/bin/sail up -d
Executar as Migrations e Seeds:

Bash
./vendor/bin/sail artisan migrate --seed
A aplicação estará acessível em seu navegador no endereço: http://localhost.

🧪 Como Rodar os Testes Automatizados
O sistema conta com suítes de testes automatizados para garantir a estabilidade das regras de negócio e endpoints. Para rodá-los dentro do container, execute:

Bash
./vendor/bin/sail artisan test