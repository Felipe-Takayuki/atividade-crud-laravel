@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div class="space-y-6">
    {{-- Cabeçalho do Dashboard / Conta --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-bold shadow-sm shrink-0">
                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Conta Ativa
                    </span>
                </div>
                <p class="text-sm text-slate-500 mt-0.5">{{ $user->email }}</p>
                <p class="text-xs text-slate-400 mt-1">
                    Membro desde {{ $user->created_at->format('d/m/Y') }}
                </p>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar Conta
            </a>
        </div>
    </div>

    {{-- Grid de Informações e Resumo --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Card Dados da Conta (CRUD 1) --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-semibold text-slate-900">Dados da Conta</h2>
                <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700">
                    CRUD 1 Completo
                </span>
            </div>

            <dl class="divide-y divide-slate-100 text-sm">
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-slate-500">ID do Usuário</dt>
                    <dd class="font-medium text-slate-900">#{{ $user->id }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-slate-500">Nome</dt>
                    <dd class="font-medium text-slate-900">{{ $user->name }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-slate-500">E-mail</dt>
                    <dd class="font-medium text-slate-900">{{ $user->email }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="text-slate-500">Última atualização</dt>
                    <dd class="font-medium text-slate-900">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        {{-- Card Resumo de Tarefas (CRUD 2 - Colega) --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-semibold text-slate-900">Minhas Tarefas</h2>
                    <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-amber-50 text-amber-800 border border-amber-200">
                        CRUD 2 (Colega)
                    </span>
                </div>

                <div class="flex items-baseline gap-2 mb-2">
                    <span class="text-4xl font-bold text-slate-900">{{ $tasksCount }}</span>
                    <span class="text-sm text-slate-500">tarefas cadastradas</span>
                </div>

                <p class="text-sm text-slate-600 leading-relaxed">
                    O módulo de gerenciamento de tarefas será implementado pelo seu colega de equipe usando o Model <code class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-800 text-xs">Task</code> e o <code class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-800 text-xs">TaskController</code>.
                </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100">
                <a href="{{ route('tasks.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                    Ir para área de Tarefas
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
