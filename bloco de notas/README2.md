Nome: Letícia Justino Maciel

 Funcionalidades do Sistema
- Autenticação Completa: Sistema de Cadastro, Login e Logout utilizando o ecossistema seguro do *Laravel Breeze*.
- Área Restrita: Painel logado protegido por sessões seguras contra acessos não autorizados.
- CRUD Completo de Notas: Permite Criar, Listar, Editar e Excluir notas por meio de uma interface fluida.
- Segurança Avançada (Criptografia): O conteúdo de cada nota é criptografado antes de ser persistido no banco de dados.
- Auditoria Automática de Datas: Registro automático de data e hora para criação e modificação (`created_at`/`updated_at`), além do rastreio de exclusão via `Soft Deletes` (`deleted_at`).

 Implementação Detalhada da Segurança

1. Isolamento e Vínculo de Dados: No `NoteController`, todas as consultas, listagens e inserções são amarradas diretamente ao ID do usuário autenticado através do relacionamento do Eloquent (`Auth::user()->notes()`). Foi implementada uma trava de segurança com `abort(403)` nos métodos de Edição, Atualização e Exclusão. Isso garante que, se um usuário mal-intencionado tentar adivinhar ou alterar a URL para acessar o ID de uma nota que não pertence a ele, o sistema bloqueará o acesso imediatamente.
2. Criptografia em Repouso (Casts): O campo `content` da tabela de notas utiliza a propriedade nativa do Laravel `protected $casts = ['content' => 'encrypted']`. Isso faz com que o framework utilize o algoritmo **AES-256-CBC** integrado à chave única do sistema (`APP_KEY`) para embaralhar o texto antes de enviá-lo ao banco de dados MySQL. Mesmo que ocorra um vazamento completo do banco de dados, as informações das notas estarão totalmente ilegíveis e seguras. Ao carregar a nota na tela do usuário dono, o Laravel faz a descriptografia automaticamente na memória.
3. Soft Deletes (Exclusão Segura): A exclusão de notas utiliza a trait `SoftDeletes`. Quando o usuário clica em "Excluir", o registro não é apagado fisicamente da tabela imediatamente. Em vez disso, o Laravel preenche o campo `deleted_at` com a data e horário exatos da ação, ocultando a nota da listagem padrão e mantendo o histórico de auditoria completo.

 Como Executar o Projeto

 Pré-requisitos
Antes de começar, você precisará ter instalado em sua máquina:
- PHP (Versão >= 8.2)
- Composer (Gerenciador de dependências do PHP)
- Node.js & NPM (Para compilação dos scripts e estilos visuais)
- Laragon ou XAMPP (Para o servidor MySQL local)

 Passo a Passo para Instalação e Execução

1. Clonar ou Baixar o Projeto:
   Baixe o código do repositório para a sua máquina local e extraia os arquivos.

2. Instalar Dependências do PHP:
   Abra o terminal do VS Code dentro da pasta correta do projeto e execute:
   ```bash
   composer install