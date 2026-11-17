@extends('layouts.app')

@section('title', 'Tarefas')

@section('content')
<div class="space-y-6">
    <div class="rounded-lg border border-zinc-200 bg-white p-5">
        <p class="text-xs font-medium uppercase tracking-wider text-zinc-400">CRUD 2</p>
        <h1 class="text-lg font-semibold text-zinc-900 mt-1">
            Área em Construção pelo seu colega de equipe!
        </h1>
        <p class="text-sm text-zinc-600 mt-1 leading-relaxed">
            Consulte o <code class="px-1.5 py-0.5 rounded bg-zinc-100 text-zinc-800 text-xs">README.md</code> para implementar o CRUD de Tarefas usando a tabela <code class="px-1.5 py-0.5 rounded bg-zinc-100 text-zinc-800 text-xs">tasks</code>, o Model <code class="px-1.5 py-0.5 rounded bg-zinc-100 text-zinc-800 text-xs">Task</code> e o <code class="px-1.5 py-0.5 rounded bg-zinc-100 text-zinc-800 text-xs">TaskController</code>.
        </p>
    </div>

    <div class="bg-white rounded-lg border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-base font-semibold text-zinc-900">Minhas tarefas</h2>
                <p class="text-xs text-zinc-500 mt-0.5">Exemplo de listagem para os registros da tabela <code>tasks</code>.</p>
            </div>
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center justify-center px-3.5 py-2 rounded-md bg-zinc-900 hover:bg-zinc-800 text-white text-sm font-medium transition">
                + Nova tarefa
            </a>
        </div>

        <div class="divide-y divide-zinc-100">
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium text-zinc-900">Implementar TaskController@store</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded bg-amber-50 text-amber-700 border border-amber-200">Em andamento</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded bg-red-50 text-red-700 border border-red-200">Alta</span>
                    </div>
                    <p class="text-xs text-zinc-500">Validar título, status, prioridade e salvar vinculado ao usuário autenticado.</p>
                </div>
                <div class="flex items-center gap-2 text-xs text-zinc-400 shrink-0">
                    <span>25/11/2026</span>
                    <span class="px-2 py-1 rounded border border-zinc-200 text-zinc-500">Editar</span>
                    <span class="px-2 py-1 rounded border border-zinc-200 text-zinc-500">Excluir</span>
                </div>
            </div>

            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium text-zinc-900">Criar views de criação e edição</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded bg-zinc-100 text-zinc-700">Pendente</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded bg-zinc-100 text-zinc-600">Média</span>
                    </div>
                    <p class="text-xs text-zinc-500">Completar os arquivos create.blade.php, edit.blade.php e show.blade.php.</p>
                </div>
                <div class="flex items-center gap-2 text-xs text-zinc-400 shrink-0">
                    <span>28/11/2026</span>
                    <span class="px-2 py-1 rounded border border-zinc-200 text-zinc-500">Editar</span>
                    <span class="px-2 py-1 rounded border border-zinc-200 text-zinc-500">Excluir</span>
                </div>
            </div>

            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium line-through text-zinc-400">Configurar autenticação e perfil (CRUD 1)</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded bg-emerald-50 text-emerald-700 border border-emerald-200">Concluída</span>
                    </div>
                    <p class="text-xs text-zinc-400">Registro, login, edição de conta e exclusão definitiva já estão prontos.</p>
                </div>
                <div class="flex items-center gap-2 text-xs text-zinc-400 shrink-0">
                    <span>Concluído</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
