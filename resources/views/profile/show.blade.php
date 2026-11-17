@extends('layouts.app')

@section('title', 'Minha Conta')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-zinc-200">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-full bg-zinc-200 text-zinc-700 flex items-center justify-center text-base font-semibold shrink-0">
                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-xl font-semibold text-zinc-900 tracking-tight">{{ $user->name }}</h1>
                <p class="text-sm text-zinc-500">{{ $user->email }}</p>
            </div>
        </div>

        <div>
            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-md border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-800 text-sm font-medium transition">
                Editar conta
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-white rounded-lg border border-zinc-200 p-6">
            <h2 class="text-sm font-semibold text-zinc-900 mb-4">Dados cadastrais</h2>

            <dl class="divide-y divide-zinc-100 text-sm">
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-zinc-500">Nome</dt>
                    <dd class="font-medium text-zinc-900">{{ $user->name }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-zinc-500">E-mail</dt>
                    <dd class="font-medium text-zinc-900">{{ $user->email }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-zinc-500">Membro desde</dt>
                    <dd class="font-medium text-zinc-900">{{ $user->created_at->format('d/m/Y') }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-zinc-500">Última atualização</dt>
                    <dd class="font-medium text-zinc-900">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-lg border border-zinc-200 p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-sm font-semibold text-zinc-900 mb-3">Tarefas</h2>
                <div class="text-3xl font-semibold text-zinc-900 tabular-nums">{{ $tasksCount }}</div>
                <p class="text-xs text-zinc-500 mt-1">
                    {{ $tasksCount === 1 ? 'tarefa vinculada à sua conta' : 'tarefas vinculadas à sua conta' }}
                </p>
            </div>

            <div class="mt-6 pt-4 border-t border-zinc-100">
                <a href="{{ route('tasks.index') }}"
                   class="inline-flex items-center gap-1.5 text-sm font-medium text-zinc-900 hover:text-zinc-600 transition">
                    <span>Abrir tarefas</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
