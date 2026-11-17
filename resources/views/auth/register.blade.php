@extends('layouts.app')

@section('title', 'Criar Conta')

@section('content')
<div class="max-w-sm mx-auto mt-8">
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-zinc-900 tracking-tight">Criar conta</h1>
        <p class="text-sm text-zinc-500 mt-1">Preencha seus dados para começar.</p>
    </div>

    <div class="bg-white rounded-lg border border-zinc-200 p-6">
        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-zinc-700 mb-1">Nome</label>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       placeholder="Seu nome"
                       class="w-full rounded-md border @error('name') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-1 transition">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">E-mail</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       placeholder="voce@exemplo.com"
                       class="w-full rounded-md border @error('email') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-1 transition">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-zinc-700 mb-1">Senha</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       placeholder="Mínimo 8 caracteres"
                       class="w-full rounded-md border @error('password') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-1 transition">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 mb-1">Confirmar senha</label>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Repita a senha"
                       class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm text-zinc-900 placeholder-zinc-400 focus:border-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-900 transition">
            </div>

            <button type="submit"
                    class="w-full rounded-md bg-zinc-900 hover:bg-zinc-800 text-white font-medium py-2 px-4 text-sm transition cursor-pointer">
                Criar conta
            </button>
        </form>
    </div>

    <p class="mt-4 text-center text-sm text-zinc-500">
        Já tem conta?
        <a href="{{ route('login') }}" class="font-medium text-zinc-900 underline underline-offset-4 hover:text-zinc-700">
            Entrar
        </a>
    </p>
</div>
@endsection
