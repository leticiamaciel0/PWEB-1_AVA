Bloco de Notas Seguro - Versão Evoluída
Nome: Letícia Justino Maciel

Funcionalidades do Sistema
Autenticação Completa: Sistema de Cadastro, Login e Logout utilizando o ecossistema seguro do Laravel Breeze.

Área Restrita: Painel logado protegido por sessões seguras contra acessos não autorizados.

CRUD Avançado de Notas: Permite criar, listar, editar e excluir notas por meio de uma interface fluida, contando agora com paginação de resultados.

Filtro e Busca por Título: Campo de pesquisa dinâmico na listagem principal para localizar notas rapidamente.

Lixeira de Notas (Soft Deletes): Interface dedicada para gerenciamento de itens excluídos, permitindo a restauração ou a exclusão definitiva dos dados.

Segurança Avançada (Criptografia): O conteúdo de cada nota é criptografado com chaves robustas antes de ser persistido no banco de dados.

Exibição de Datas Formatadas: Apresentação legível no padrão brasileiro (d/m/Y H:i) de todos os marcos de tempo (criação, modificação e exclusão).

Implementação Detalhada da Segurança e Melhorias
1. Organização da Interface com Blade Layouts
A arquitetura visual do sistema foi reestruturada utilizando a herança de templates nativa do Blade através das diretivas @extends, @section e @yield. Um layout global centraliza elementos repetitivos, como o menu de navegação, a identificação da usuária e a exibição de alertas de sucesso, tornando o código das páginas internas limpo, modular e padronizado.

2. Controle de Autorização com Policies
A validação de segurança foi elevada para o padrão profissional do framework com a criação de uma Policy dedicada (NotePolicy). Em vez de travas manuais no controller, o sistema agora utiliza o mecanismo de autorização nativo do Laravel para verificar se o usuário logado é o real proprietário da nota antes de permitir a visualização, edição, exclusão ou restauração. Qualquer tentativa de manipulação de IDs via URL resulta em um bloqueio imediato com o erro 403 Forbidden.

3. Criptografia em Repouso (Casts)
O campo de conteúdo da tabela de notas utiliza a propriedade nativa protected $casts = ['content' => 'encrypted'] no Model. Isso faz com que o framework utilize o algoritmo AES-256-CBC integrado à chave única do sistema (APP_KEY) para embaralhar o texto antes de enviá-lo ao banco de dados. Mesmo em um cenário de vazamento do banco, as informações estarão totalmente ilegíveis. A descriptografia ocorre automaticamente na memória apenas quando o dono legítimo acessa a tela.

4. Rotina Completa de Soft Deletes e Lixeira
A exclusão temporária foi expandida para uma ferramenta completa de auditoria e recuperação. Ao apagar uma nota, o registro recebe a marcação da data e horário exatos no campo deleted_at. O item sai da listagem principal e vai para a página de Lixeira. Nessa tela, o usuário pode acompanhar quando a nota foi removida, optar por devolvê-la ao painel principal através da função de restauração ou eliminá-la permanentemente do banco através do método de exclusão definitiva.

Como Executar o Projeto
Pré-requisitos
Antes de começar, você precisará ter instalado em sua máquina:

PHP (Versão >= 8.2)

Composer (Gerenciador de dependências do PHP)

Node.js & NPM (Para compilação dos scripts e estilos visuais)

Laragon ou XAMPP (Para o servidor local)

Passo a Passo para Instalação e Execução
Clonar ou Baixar o Projeto:
Baixe o código do repositório para a sua máquina local e extraia os arquivos.

Instalar Dependências do PHP:
Abra o terminal dentro da pasta do projeto e execute:

Bash
composer install
Instalar Dependências JavaScript:
No mesmo terminal, instale os pacotes necessários para o front-end:

Bash
npm install
Configurar o Arquivo de Ambiente:
Duplique o arquivo .env.example, renomeie a cópia para .env e configure a chave da aplicação e a conexão com o seu banco de dados local.

Executar as Migrations:
Crie as tabelas no banco de dados com o comando:

Bash
php artisan migrate
Iniciar os Servidores:
Inicie o servidor de desenvolvimento do PHP e o compilador do Vite em terminais separados:

Bash
php artisan serve
Bash
npm run dev
