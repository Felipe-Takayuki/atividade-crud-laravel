# Tasks — Atividade Prática de CRUDs em Laravel

Sistema de gerenciamento pessoal de tarefas desenvolvido em **Laravel 13** com **SQLite** e **Tailwind CSS (via CDN)**.
O projeto foi estruturado em **duas features (CRUDs) independentes e integradas** para trabalho em dupla:

- **CRUD 1 (Concluído 100%):** Autenticação e Gestão da Conta do Usuário (`RegisterController`, `AuthController`, `ProfileController`).
- **CRUD 2 (Concluído 100%):** Gestão de Tarefas (`TaskController`, Model `Task`, Views em `resources/views/tasks/`).

---

## Como Executar o Projeto

### Pré-requisitos
- PHP 8.3+ (com extensões `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`)
- Composer

### Passo a passo

```bash
# 1. Instalar dependências (caso ainda não tenha rodado)
composer install

# 2. Copiar o .env e gerar a chave (já configurado neste repositório)
cp -n .env.example .env
php artisan key:generate

# 3. Garantir o banco SQLite e rodar as migrations
touch database/database.sqlite
php artisan migrate

# 4. Iniciar o servidor local
php artisan serve
```

Acesse no navegador: **http://127.0.0.1:8000**

> **Observação:** O layout utiliza Tailwind CSS via CDN (`https://cdn.tailwindcss.com`), portanto **não é necessário rodar `npm install` ou `npm run dev`**.

---

## Arquitetura do Banco de Dados

### Tabela `users`
- `id` (PK)
- `name` (string)
- `email` (string, unique)
- `password` (hashed)
- `remember_token`, `timestamps`

### Tabela `tasks`
- `id` (PK)
- `user_id` (FK -> `users.id` com `cascadeOnDelete()`)
- `title` (string)
- `description` (text, nullable)
- `status` (`enum`: `'pending'`, `'in_progress'`, `'completed'`, default `'pending'`)
- `priority` (`enum`: `'low'`, `'medium'`, `'high'`, default `'medium'`)
- `due_date` (date, nullable)
- `timestamps`

---

## O que Já Foi Implementado — CRUD 1 (Conta & Autenticação)

1. **Autenticação e Proteção de Rotas**
   - `GET /login` e `POST /login`: Login com validação, "Manter conectado" (`remember`) e regeneração de sessão.
   - `POST /logout`: Logout seguro com CSRF, invalidação de sessão e regeneração de token.
   - Middlewares `guest` e `auth` configurados em `bootstrap/app.php` e `routes/web.php`.
2. **Create (Registro de Conta)**
   - `GET /register` e `POST /register`: Validação de nome, e-mail único e senha confirmada (mínimo 8 caracteres), criação do usuário e auto-login.
3. **Read (Visualização de Perfil / Dashboard)**
   - `GET /profile`: Exibe os dados da conta autenticada, data de cadastro e resumo da contagem de tarefas vinculadas.
4. **Update (Edição de Dados e Senha)**
   - `GET /profile/edit`: Tela de configurações da conta.
   - `PATCH /profile`: Atualização de nome e e-mail (validando unicidade ignorando o próprio usuário).
   - `PUT /profile/password`: Alteração de senha exigindo a senha atual (`current_password`) e confirmação da nova senha.
5. **Delete (Exclusão Definitiva da Conta)**
   - `DELETE /profile`: Exige a confirmação da senha atual (em modal dedicado), realiza logout, remove o usuário do banco (excluindo em cascata todas as tarefas vinculadas) e invalida a sessão.

---

## O que Foi Implementado — CRUD 2 (Gestão de Tarefas)

O CRUD completo de tarefas (`Task`) pertencentes ao usuário autenticado foi totalmente implementado utilizando as 7 ações resource:

1. **Listagem (`GET /tasks` &rarr; `TaskController@index` + `resources/views/tasks/index.blade.php`)**
   - Busca real no banco apenas das tarefas do usuário autenticado: `Auth::user()->tasks()->latest()->get()`.
   - Exibição de cada tarefa com badges coloridos para `status` (`pending`, `in_progress`, `completed`) e `priority` (`low`, `medium`, `high`).
   - Apresentação de descrição, prazo formatado (`d/m/Y`) e data de cadastro.
   - Botões de ação rápida para cada registro: **Ver**, **Editar** e **Excluir** (com formulário `@method('DELETE')` + `@csrf` e confirmação antes de excluir).
   - Estado vazio (*empty state*) intuitivo caso o usuário ainda não possua tarefas.

2. **Criação (`GET /tasks/create` e `POST /tasks` &rarr; `TaskController@create` e `store` + `resources/views/tasks/create.blade.php`)**
   - Formulário com `@csrf` apontando para `route('tasks.store')`.
   - Validação completa no controller (`title`, `description`, `status`, `priority`, `due_date`).
   - Persistência vinculada ao usuário autenticado via relacionamento: `Auth::user()->tasks()->create($validated)`.
   - Redirecionamento para a listagem com mensagem flash de sucesso.

3. **Detalhes (`GET /tasks/{task}` &rarr; `TaskController@show` + `resources/views/tasks/show.blade.php`)**
   - Verificação de propriedade e segurança contra IDOR (`abort_if($task->user_id !== Auth::id(), 403);`).
   - Exibição de título, status, prioridade, descrição completa, prazo e datas de criação e última atualização.
   - Acesso direto às opções de edição e exclusão da tarefa.

4. **Edição (`GET /tasks/{task}/edit` e `PUT /tasks/{task}` &rarr; `TaskController@edit` e `update` + `resources/views/tasks/edit.blade.php`)**
   - Verificação de propriedade (`abort_if`).
   - Formulário pré-preenchido utilizando `@method('PUT')`, `@csrf` e `old('campo', $task->campo)`.
   - Validação dos dados, execução de `$task->update($validated)` e redirecionamento com mensagem de sucesso.

5. **Exclusão (`DELETE /tasks/{task}` &rarr; `TaskController@destroy`)**
   - Verificação de propriedade (`abort_if`).
   - Exclusão do registro via `$task->delete()`.
   - Redirecionamento para a listagem com feedback de confirmação (`session('success')`).

---

## Testes Automatizados

Para rodar a suíte de testes do projeto:

```bash
php artisan test
```
