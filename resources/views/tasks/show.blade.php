@extends('layouts.app')

@section('title', $task->title)

@section('content')
@php
    $statusMap = [
        'pending'     => ['label' => 'Pendente',     'class' => 'bg-zinc-100 text-zinc-700 border-zinc-200'],
        'in_progress' => ['label' => 'Em andamento', 'class' => 'bg-amber-50 text-amber-700 border-amber-200'],
        'completed'   => ['label' => 'Concluída',    'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
    ];
    $priorityMap = [
        'low'    => ['label' => 'Baixa', 'class' => 'bg-zinc-100 text-zinc-600 border-zinc-200'],
        'medium' => ['label' => 'Média', 'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
        'high'   => ['label' => 'Alta',  'class' => 'bg-red-50 text-red-700 border-red-200'],
    ];
    $statusInfo = $statusMap[$task->status] ?? ['label' => ucfirst($task->status), 'class' => 'bg-zinc-100 text-zinc-700 border-zinc-200'];
    $priorityInfo = $priorityMap[$task->priority] ?? ['label' => ucfirst($task->priority), 'class' => 'bg-zinc-100 text-zinc-600 border-zinc-200'];
@endphp

<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-900 transition">
            &larr; Voltar para a lista
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('tasks.edit', $task) }}"
               class="px-3 py-1.5 rounded-md border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-800 text-xs font-medium transition">
                Editar
            </a>
            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1.5 rounded-md border border-zinc-200 bg-white hover:bg-red-50 hover:text-red-600 hover:border-red-200 text-xs font-medium text-zinc-700 transition cursor-pointer">
                    Excluir
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-zinc-200 overflow-hidden">
        <div class="p-6 border-b border-zinc-100 space-y-3">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-2.5 py-0.5 text-xs font-medium rounded border {{ $statusInfo['class'] }}">
                    {{ $statusInfo['label'] }}
                </span>
                <span class="px-2.5 py-0.5 text-xs font-medium rounded border {{ $priorityInfo['class'] }}">
                    Prioridade {{ $priorityInfo['label'] }}
                </span>
            </div>

            <h1 class="text-xl font-bold text-zinc-900 tracking-tight {{ $task->status === 'completed' ? 'line-through text-zinc-500' : '' }}">
                {{ $task->title }}
            </h1>
        </div>

        <div class="p-6 space-y-6">
            <div>
                <h2 class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2">Descrição</h2>
                @if ($task->description)
                    <div class="text-sm text-zinc-700 whitespace-pre-line leading-relaxed bg-zinc-50 rounded-md p-4 border border-zinc-100">
                        {{ $task->description }}
                    </div>
                @else
                    <p class="text-sm text-zinc-400 italic">Nenhuma descrição informada.</p>
                @endif
            </div>

            <div class="pt-4 border-t border-zinc-100">
                <h2 class="text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-3">Informações</h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="p-3 bg-zinc-50 rounded-md border border-zinc-100">
                        <dt class="text-xs text-zinc-500">Prazo de conclusão</dt>
                        <dd class="text-sm font-medium text-zinc-900 mt-0.5">
                            {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Não definido' }}
                        </dd>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-md border border-zinc-100">
                        <dt class="text-xs text-zinc-500">Status atual</dt>
                        <dd class="text-sm font-medium text-zinc-900 mt-0.5">
                            {{ $statusInfo['label'] }}
                        </dd>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-md border border-zinc-100">
                        <dt class="text-xs text-zinc-500">Data de criação</dt>
                        <dd class="text-sm font-medium text-zinc-900 mt-0.5">
                            {{ $task->created_at->format('d/m/Y \à\s H:i') }}
                        </dd>
                    </div>

                    <div class="p-3 bg-zinc-50 rounded-md border border-zinc-100">
                        <dt class="text-xs text-zinc-500">Última atualização</dt>
                        <dd class="text-sm font-medium text-zinc-900 mt-0.5">
                            {{ $task->updated_at->format('d/m/Y \à\s H:i') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
