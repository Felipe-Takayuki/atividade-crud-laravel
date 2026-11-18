@extends('layouts.app')

@section('title', 'Nova Tarefa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg border border-zinc-200 p-6">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-100">
            <div>
                <h1 class="text-lg font-semibold text-zinc-900">Nova tarefa</h1>
                <p class="text-sm text-zinc-500 mt-0.5">Preencha os campos para cadastrar uma nova tarefa.</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-900 transition">
                &larr; Voltar
            </a>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
            @csrf

            @include('tasks._form', ['submitLabel' => 'Salvar tarefa'])
        </form>
    </div>
</div>
@endsection
