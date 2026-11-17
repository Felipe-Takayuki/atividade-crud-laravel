@extends('layouts.app')

@section('title', 'Entrar')

@section('content')
<div class="max-w-md mx-auto mt-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Entrar no TaskFlow</h1>
            <p class="text-sm text-slate-500 mt-1">Acesse sua conta para gerenciar seu perfil e tarefas.</p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">E-mail</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="email"
                       placeholder="voce@exemplo.com"
                       class="w-full rounded-xl border @error('email') border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-indigo-500 @enderror px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                @error('email')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Senha</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full rounded-xl border @error('password') border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-indigo-500 @enderror px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                @error('password')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                    <input type="checkbox"
                           name="remember"
                           value="1"
                           {{ old('remember') ? 'checked' : '' }}
                           class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Manter conectado</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 text-sm shadow-sm transition cursor-pointer">
                Entrar
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-100 text-center text-sm text-slate-600">
            Ainda não tem uma conta?
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                Criar conta gratuitamente
            </a>
        </div>
    </div>
</div>
@endsection
