<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * CRUD 2: Gestão de Tarefas (Atividade do Colega)
 *
 * Este controller já está conectado às rotas resource em routes/web.php.
 * Siga os comentários TODO de cada método e as instruções do README.md
 * para implementar o CRUD completo de Tarefas vinculadas ao usuário logado.
 */
class TaskController extends Controller
{
    /**
     * READ (Listagem): Exibe todas as tarefas do usuário autenticado.
     */
    public function index(): View
    {
        // TODO (CRUD 2): Substituir a tela de "Em Construção" pela listagem real:
        // 1. Buscar as tarefas do usuário logado:
        //    $tasks = Auth::user()->tasks()->latest()->get();
        //    (Dica bônus: adicione filtro opcional por ?status=pending|in_progress|completed)
        // 2. Retornar a view passando as tarefas:
        //    return view('tasks.index', compact('tasks'));

        return view('tasks.index');
    }

    /**
     * CREATE (Formulário): Exibe o formulário para criar uma nova tarefa.
     */
    public function create(): View
    {
        // TODO (CRUD 2): Retornar a view do formulário de criação:
        // return view('tasks.create');

        return view('tasks.create');
    }

    /**
     * CREATE (Persistência): Valida os dados e salva a nova tarefa no banco.
     */
    public function store(Request $request): RedirectResponse
    {
        // TODO (CRUD 2):
        // 1. Validar os campos recebidos do formulário:
        //    $validated = $request->validate([
        //        'title' => ['required', 'string', 'max:255'],
        //        'description' => ['nullable', 'string'],
        //        'status' => ['required', 'in:pending,in_progress,completed'],
        //        'priority' => ['required', 'in:low,medium,high'],
        //        'due_date' => ['nullable', 'date'],
        //    ]);
        //
        // 2. Criar a tarefa vinculada ao usuário autenticado:
        //    Auth::user()->tasks()->create($validated);
        //
        // 3. Redirecionar para a listagem com mensagem de sucesso:
        //    return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');

        return redirect()
            ->route('tasks.index')
            ->with('error', 'Método TaskController@store ainda não foi implementado.');
    }

    /**
     * READ (Detalhe): Exibe os detalhes de uma tarefa específica.
     */
    public function show(Task $task): View
    {
        // TODO (CRUD 2):
        // 1. Garantir que a tarefa pertence ao usuário autenticado (autorização):
        //    abort_if($task->user_id !== Auth::id(), 403);
        //
        // 2. Retornar a view de detalhes:
        //    return view('tasks.show', compact('task'));

        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.show', compact('task'));
    }

    /**
     * UPDATE (Formulário): Exibe o formulário preenchido para editar uma tarefa.
     */
    public function edit(Task $task): View
    {
        // TODO (CRUD 2):
        // 1. Verificar se o usuário é o dono da tarefa:
        //    abort_if($task->user_id !== Auth::id(), 403);
        //
        // 2. Retornar a view de edição:
        //    return view('tasks.edit', compact('task'));

        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.edit', compact('task'));
    }

    /**
     * UPDATE (Persistência): Valida e atualiza a tarefa no banco de dados.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        // TODO (CRUD 2):
        // 1. Verificar se o usuário é o dono da tarefa:
        //    abort_if($task->user_id !== Auth::id(), 403);
        //
        // 2. Validar os campos (mesmas regras do método store):
        //    $validated = $request->validate([...]);
        //
        // 3. Atualizar a tarefa:
        //    $task->update($validated);
        //
        // 4. Redirecionar com feedback:
        //    return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');

        abort_if($task->user_id !== Auth::id(), 403);

        return redirect()
            ->route('tasks.index')
            ->with('error', 'Método TaskController@update ainda não foi implementado.');
    }

    /**
     * DELETE: Remove permanentemente uma tarefa do banco de dados.
     */
    public function destroy(Task $task): RedirectResponse
    {
        // TODO (CRUD 2):
        // 1. Verificar se o usuário é o dono da tarefa:
        //    abort_if($task->user_id !== Auth::id(), 403);
        //
        // 2. Excluir a tarefa:
        //    $task->delete();
        //
        // 3. Redirecionar com mensagem de sucesso:
        //    return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');

        abort_if($task->user_id !== Auth::id(), 403);

        return redirect()
            ->route('tasks.index')
            ->with('error', 'Método TaskController@destroy ainda não foi implementado.');
    }
}
