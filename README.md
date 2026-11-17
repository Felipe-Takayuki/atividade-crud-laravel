# Tasks — Atividade Prática de CRUDs em Laravel

Sistema de gerenciamento pessoal de tarefas desenvolvido em **Laravel 13** com **SQLite** e **Tailwind CSS (via CDN)**.
O projeto foi estruturado em **duas features (CRUDs) independentes e integradas** para trabalho em dupla:

- **CRUD 1 (Concluído 100%):** Autenticação e Gestão da Conta do Usuário (`RegisterController`, `AuthController`, `ProfileController`).
- **CRUD 2 (Atividade do Colega):** Gestão de Tarefas (`TaskController`, Model `Task`, Views em `resources/views/tasks/`).

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

### Tabela `tasks` (Pronta para o CRUD 2)
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
   - `GET /profile`: Exibe os dados da conta autenticada, data de cadastro e resumo da contagem de tarefas.
4. **Update (Edição de Dados e Senha)**
   - `GET /profile/edit`: Tela de configurações da conta.
   - `PATCH /profile`: Atualização de nome e e-mail (validando unicidade ignorando o próprio usuário).
   - `PUT /profile/password`: Alteração de senha exigindo a senha atual (`current_password`) e confirmação da nova senha.
5. **Delete (Exclusão Definitiva da Conta)**
   - `DELETE /profile`: Exige a confirmação da senha atual (em modal dedicado), realiza logout, remove o usuário do banco (excluindo em cascata todas as tarefas vinculadas) e invalida a sessão.

---

## Tarefa CRUD 2 (Gestão de Tarefas / Tasks)

A segunda feature da atividade é implementar o **CRUD completo de Tarefas (`Task`)** pertencentes ao usuário autenticado.

### O que já está preparado
- **Migration:** `database/migrations/2026_11_17_020142_create_tasks_table.php` (já migrada no SQLite).
- **Model `Task`:** `app/Models/Task.php` com `$fillable`, `casts()` para `due_date` e relacionamento `belongsTo(User::class)`.
- **Model `User`:** `app/Models/User.php` atualizado com o relacionamento `hasMany(Task::class)`.
- **Rotas:** `Route::resource('tasks', TaskController::class);` já registrada em `routes/web.php` dentro do grupo `middleware('auth')`.
- **Controller Stub:** `app/Http/Controllers/TaskController.php` com todos os 7 métodos (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) e comentários `TODO`.
- **Views Stubs:** `resources/views/tasks/` (`index.blade.php`, `create.blade.php`, `edit.blade.php`, `show.blade.php`).

### Passo a Passo do que implementar

1. **Listagem (`TaskController@index` + `resources/views/tasks/index.blade.php`)**
   - Substituir o mockup estático pela busca real:
     ```php
     $tasks = Auth::user()->tasks()->latest()->get();
     return view('tasks.index', compact('tasks'));
     ```
   - Exibir cada tarefa em uma lista/tabela com badges coloridos de `status` e `priority`, além dos botões **Ver**, **Editar** e **Excluir** (com `<form method="POST">` + `@method('DELETE')` + `@csrf`).

2. **Criação (`TaskController@create` e `TaskController@store` + `resources/views/tasks/create.blade.php`)**
   - Montar o formulário em `create.blade.php` apontando para `route('tasks.store')`.
   - No método `store`, validar os dados e salvar via relacionamento:
     ```php
     $validated = $request->validate([
         'title'       => ['required', 'string', 'max:255'],
         'description' => ['nullable', 'string'],
         'status'      => ['required', 'in:pending,in_progress,completed'],
         'priority'    => ['required', 'in:low,medium,high'],
         'due_date'    => ['nullable', 'date'],
     ]);

     Auth::user()->tasks()->create($validated);

     return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
     ```

3. **Detalhes (`TaskController@show` + `resources/views/tasks/show.blade.php`)**
   - Garantir que o usuário só veja suas próprias tarefas (`abort_if($task->user_id !== Auth::id(), 403);`).
   - Exibir título, descrição completa, status, prioridade, prazo e datas de criação/atualização.

4. **Edição (`TaskController@edit` e `TaskController@update` + `resources/views/tasks/edit.blade.php`)**
   - Verificar propriedade (`abort_if($task->user_id !== Auth::id(), 403);`).
   - Montar o formulário em `edit.blade.php` usando `@method('PUT')` e `old('campo', $task->campo)`.
   - Validar e chamar `$task->update($validated);`, redirecionando com mensagem de sucesso.

5. **Exclusão (`TaskController@destroy`)**
   - Verificar propriedade (`abort_if($task->user_id !== Auth::id(), 403);`).
   - Executar `$task->delete();` e redirecionar para `route('tasks.index')` com `session('success')`.

### Ideias Bônus (Opcional)
- Filtro por `status` e `priority` na listagem (`?status=pending`).
- Botão rápido para marcar tarefa como `completed` diretamente na listagem.
- Testes automatizados em `tests/Feature/TaskCrudTest.php`.

---

## Testes Automatizados

Para rodar a suíte de testes do CRUD 1:

```bash
php artisan test
```
