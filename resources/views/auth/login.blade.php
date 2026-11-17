@extends('layouts.app')

@section('title', 'Entrar')

@section('content')
<div class="max-w-sm mx-auto mt-10">
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-zinc-900 tracking-tight">Entrar</h1>
        <p class="text-sm text-zinc-500 mt-1">Informe seu e-mail e senha para acessar sua conta.</p>
    </div>

    <div class="bg-white rounded-lg border border-zinc-200 p-6">
        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">E-mail</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
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
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full rounded-md border @error('password') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-1 transition">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <label class="inline-flex items-center gap-2 text-sm text-zinc-600 cursor-pointer">
                    <input type="checkbox"
                           name="remember"
                           value="1"
                           {{ old('remember') ? 'checked' : '' }}
                           class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900">
                    <span>Manter conectado</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full rounded-md bg-zinc-900 hover:bg-zinc-800 text-white font-medium py-2 px-4 text-sm transition cursor-pointer">
                Entrar
            </button>
        </form>
    </div>

    <p class="mt-4 text-center text-sm text-zinc-500">
        Não tem conta?
        <a href="{{ route('register') }}" class="font-medium text-zinc-900 underline underline-offset-4 hover:text-zinc-700">
            Criar uma agora
        </a>
    </p>
</div>
@endsection
