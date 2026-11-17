@extends('layouts.app')

@section('title', 'Editar Tarefa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-slate-900">Editar Tarefa</h1>
                <p class="text-sm text-slate-500 mt-1">Stub preparado para o CRUD 2 (ver README.md).</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                &larr; Voltar
            </a>
        </div>

        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
            <strong>Guia para o colega:</strong> Implemente aqui o formulário enviando via <code>PUT/PATCH</code> para <code>route('tasks.update', $task)</code> usando <code>old('campo', $task->campo)</code>.
        </div>

        {{-- TODO (CRUD 2): Construir formulário de edição com @csrf e @method('PUT') --}}
    </div>
</div>
@endsection
