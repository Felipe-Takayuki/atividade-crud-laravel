@extends('layouts.app')

@section('title', 'Tarefas (Em Construção)')

@section('content')
<div class="space-y-6">
    {{-- Aviso principal para a atividade do colega --}}
    <div class="rounded-2xl border-2 border-dashed border-amber-300 bg-amber-50/80 p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row sm:items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <div class="space-y-2">
                <span class="inline-block text-xs font-semibold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-amber-200/80 text-amber-900">
                    CRUD 2 — Sua Tarefa
                </span>
                <h1 class="text-xl font-bold text-slate-900">
                    Área em Construção pelo seu colega de equipe!
                </h1>
                <p class="text-sm text-slate-700 leading-relaxed">
                    Veja o <code class="px-1.5 py-0.5 rounded bg-white border border-amber-200 font-semibold text-amber-900">README.md</code> para implementar o CRUD de Tarefas.
                    A tabela <code class="px-1.5 py-0.5 rounded bg-white border border-amber-200 text-xs">tasks</code>, o Model <code class="px-1.5 py-0.5 rounded bg-white border border-amber-200 text-xs">Task</code>, as rotas resource e os stubs em <code class="px-1.5 py-0.5 rounded bg-white border border-amber-200 text-xs">TaskController</code> já estão preparados!
                </p>
            </div>
        </div>
    </div>

    {{-- Mockup visual de como a tela de tarefas ficará após implementação --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Minhas Tarefas (Prévia / Mockup)</h2>
                <p class="text-xs text-slate-500 mt-0.5">Exemplo ilustrativo de como os registros da tabela <code>tasks</code> serão exibidos.</p>
            </div>
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition">
                <span>+ Nova Tarefa</span>
            </a>
        </div>

        <div class="divide-y divide-slate-100 opacity-75">
            {{-- Item Mock 1 --}}
            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-semibold text-slate-900">Implementar TaskController@store</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Em andamento</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-rose-100 text-rose-800">Prioridade Alta</span>
                    </div>
                    <p class="text-sm text-slate-500">Validar título, status, prioridade e salvar vinculado ao usuário autenticado.</p>
                </div>
                <div class="flex items-center gap-3 text-xs text-slate-400 shrink-0">
                    <span>Prazo: 25/11/2026</span>
                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-medium">Editar</span>
                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-medium">Excluir</span>
                </div>
            </div>

            {{-- Item Mock 2 --}}
            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-semibold text-slate-900">Criar views de criação e edição</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-700">Pendente</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-sky-100 text-sky-800">Prioridade Média</span>
                    </div>
                    <p class="text-sm text-slate-500">Completar os arquivos create.blade.php, edit.blade.php e show.blade.php.</p>
                </div>
                <div class="flex items-center gap-3 text-xs text-slate-400 shrink-0">
                    <span>Prazo: 28/11/2026</span>
                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-medium">Editar</span>
                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-medium">Excluir</span>
                </div>
            </div>

            {{-- Item Mock 3 --}}
            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-semibold text-slate-900 line-through text-slate-500">Configurar autenticação e perfil (CRUD 1)</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800">Concluída</span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-600">Prioridade Baixa</span>
                    </div>
                    <p class="text-sm text-slate-500">Registro, login, edição de conta e exclusão definitiva já estão prontos.</p>
                </div>
                <div class="flex items-center gap-3 text-xs text-slate-400 shrink-0">
                    <span>Concluído</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
