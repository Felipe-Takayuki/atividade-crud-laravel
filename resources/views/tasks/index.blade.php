@extends('layouts.app')

@section('title', 'Tarefas')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-base font-semibold text-zinc-900">Minhas tarefas</h1>
                <p class="text-xs text-zinc-500 mt-0.5">Gerencie suas tarefas pessoais e acompanhe seus prazos.</p>
            </div>
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center justify-center px-3.5 py-2 rounded-md bg-zinc-900 hover:bg-zinc-800 text-white text-sm font-medium transition cursor-pointer">
                + Nova tarefa
            </a>
        </div>

        @if ($tasks->isEmpty())
            <div class="px-6 py-12 text-center">
                <div class="w-12 h-12 rounded-full bg-zinc-100 text-zinc-400 mx-auto flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-zinc-900">Nenhuma tarefa encontrada</h3>
                <p class="text-xs text-zinc-500 mt-1 max-w-sm mx-auto">Você ainda não possui tarefas cadastradas. Clique no botão abaixo para criar sua primeira tarefa.</p>
                <div class="mt-4">
                    <a href="{{ route('tasks.create') }}"
                       class="inline-flex items-center px-3 py-1.5 rounded-md bg-zinc-900 hover:bg-zinc-800 text-white text-xs font-medium transition">
                        Criar primeira tarefa
                    </a>
                </div>
            </div>
        @else
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
            @endphp

            <div class="divide-y divide-zinc-100">
                @foreach ($tasks as $task)
                    @php
                        $statusInfo = $statusMap[$task->status] ?? ['label' => ucfirst($task->status), 'class' => 'bg-zinc-100 text-zinc-700 border-zinc-200'];
                        $priorityInfo = $priorityMap[$task->priority] ?? ['label' => ucfirst($task->priority), 'class' => 'bg-zinc-100 text-zinc-600 border-zinc-200'];
                    @endphp
                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-zinc-50/60 transition">
                        <div class="space-y-1 min-w-0 flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('tasks.show', $task) }}"
                                   class="text-sm font-medium text-zinc-900 hover:text-zinc-600 transition truncate {{ $task->status === 'completed' ? 'line-through text-zinc-500' : '' }}">
                                    {{ $task->title }}
                                </a>
                                <span class="px-2 py-0.5 text-xs font-medium rounded border {{ $statusInfo['class'] }}">
                                    {{ $statusInfo['label'] }}
                                </span>
                                <span class="px-2 py-0.5 text-xs font-medium rounded border {{ $priorityInfo['class'] }}">
                                    {{ $priorityInfo['label'] }}
                                </span>
                            </div>

                            @if ($task->description)
                                <p class="text-xs text-zinc-500 line-clamp-2">{{ $task->description }}</p>
                            @endif

                            <div class="flex items-center gap-4 text-xs text-zinc-400 pt-0.5">
                                @if ($task->due_date)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Prazo: {{ $task->due_date->format('d/m/Y') }}</span>
                                    </span>
                                @endif
                                <span>Criada em {{ $task->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <a href="{{ route('tasks.show', $task) }}"
                               class="px-2.5 py-1.5 rounded-md border border-zinc-200 bg-white hover:bg-zinc-50 text-xs font-medium text-zinc-700 transition">
                                Ver
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="px-2.5 py-1.5 rounded-md border border-zinc-200 bg-white hover:bg-zinc-50 text-xs font-medium text-zinc-700 transition">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-2.5 py-1.5 rounded-md border border-zinc-200 bg-white hover:bg-red-50 hover:text-red-600 hover:border-red-200 text-xs font-medium text-zinc-700 transition cursor-pointer">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
