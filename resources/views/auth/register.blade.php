@extends('layouts.app')

@section('title', 'Criar Conta')

@section('content')
<div class="max-w-md mx-auto mt-4">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Criar nova conta</h1>
            <p class="text-sm text-slate-500 mt-1">Preencha os dados abaixo para começar a usar o TaskFlow.</p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nome completo</label>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       placeholder="Seu nome"
                       class="w-full rounded-xl border @error('name') border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-indigo-500 @enderror px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">E-mail</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
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
                       autocomplete="new-password"
                       placeholder="Mínimo de 8 caracteres"
                       class="w-full rounded-xl border @error('password') border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-indigo-500 @enderror px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                @error('password')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirmar senha</label>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Repita a senha"
                       class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
            </div>

            <button type="submit"
                    class="w-full mt-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 text-sm shadow-sm transition cursor-pointer">
                Cadastrar e entrar
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-100 text-center text-sm text-slate-600">
            Já possui uma conta?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                Fazer login
            </a>
        </div>
    </div>
</div>
@endsection
