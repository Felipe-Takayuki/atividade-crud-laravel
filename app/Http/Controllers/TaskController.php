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
 * Conectado às rotas resource em routes/web.php.
 * Implementa o CRUD completo de Tarefas vinculadas ao usuário autenticado.
 */
class TaskController extends Controller
{
    /**
     * READ (Listagem): Exibe todas as tarefas do usuário autenticado.
     */
    public function index(): View
    {
        $tasks = Auth::user()->tasks()->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * CREATE (Formulário): Exibe o formulário para criar uma nova tarefa.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * CREATE (Persistência): Valida os dados e salva a nova tarefa no banco.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'in:pending,in_progress,completed'],
            'priority'    => ['required', 'in:low,medium,high'],
            'due_date'    => ['nullable', 'date'],
        ]);

        Auth::user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * READ (Detalhe): Exibe os detalhes de uma tarefa específica.
     */
    public function show(Task $task): View
    {
        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.show', compact('task'));
    }

    /**
     * UPDATE (Formulário): Exibe o formulário preenchido para editar uma tarefa.
     */
    public function edit(Task $task): View
    {
        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.edit', compact('task'));
    }

    /**
     * UPDATE (Persistência): Valida e atualiza a tarefa no banco de dados.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'in:pending,in_progress,completed'],
            'priority'    => ['required', 'in:low,medium,high'],
            'due_date'    => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * DELETE: Remove permanentemente uma tarefa do banco de dados.
     */
    public function destroy(Task $task): RedirectResponse
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
