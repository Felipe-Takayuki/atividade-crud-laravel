@extends('layouts.app')

@section('title', 'Editar Tarefa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg border border-zinc-200 p-6">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-100">
            <div>
                <h1 class="text-lg font-semibold text-zinc-900">Editar tarefa</h1>
                <p class="text-sm text-zinc-500 mt-0.5">Stub preparado para o CRUD 2 (ver README.md).</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-900">
                &larr; Voltar
            </a>
        </div>

        <div class="rounded-md border border-zinc-200 bg-zinc-50 p-4 text-sm text-zinc-700">
            <strong>Guia para o colega:</strong> Implemente aqui o formulário enviando via <code>PUT/PATCH</code> para <code>route('tasks.update', $task)</code> usando <code>old('campo', $task->campo)</code>.
        </div>

        {{-- TODO (CRUD 2): Construir formulário de edição com @csrf e @method('PUT') --}}
    </div>
</div>
@endsection
