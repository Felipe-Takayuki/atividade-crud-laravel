@extends('layouts.app')

@section('title', 'Editar Conta')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Configurações da Conta</h1>
            <p class="text-sm text-slate-500 mt-0.5">Atualize seus dados pessoais, altere sua senha ou exclua sua conta.</p>
        </div>
        <a href="{{ route('profile.show') }}"
           class="text-sm font-medium text-slate-600 hover:text-slate-900">
            &larr; Voltar ao Perfil
        </a>
    </div>

    {{-- 1. Atualizar Nome e E-mail --}}
    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <div class="mb-5">
            <h2 class="text-lg font-semibold text-slate-900">Informações do Perfil</h2>
            <p class="text-sm text-slate-500">Atualize seu nome de exibição e endereço de e-mail.</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nome</label>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       required
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
                       value="{{ old('email', $user->email) }}"
                       required
                       class="w-full rounded-xl border @error('email') border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-indigo-500 @enderror px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                @error('email')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition cursor-pointer">
                    Salvar alterações
                </button>
            </div>
        </form>
    </section>

    {{-- 2. Alterar Senha --}}
    <section class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <div class="mb-5">
            <h2 class="text-lg font-semibold text-slate-900">Alterar Senha</h2>
            <p class="text-sm text-slate-500">Para sua segurança, informe a senha atual antes de definir uma nova.</p>
        </div>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-slate-700 mb-1.5">Senha atual</label>
                <input id="current_password"
                       type="password"
                       name="current_password"
                       required
                       autocomplete="current-password"
                       class="w-full rounded-xl border @error('current_password') border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-indigo-500 @enderror px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                @error('current_password')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Nova senha</label>
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
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirmar nova senha</label>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold shadow-sm transition cursor-pointer">
                    Atualizar senha
                </button>
            </div>
        </form>
    </section>

    {{-- 3. Zona de Perigo: Excluir Conta --}}
    <section class="bg-white rounded-2xl border border-rose-200 shadow-sm p-6 sm:p-8">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-rose-700">Zona de Perigo — Excluir Conta</h2>
            <p class="text-sm text-slate-600 mt-1">
                Ao excluir sua conta, todos os seus dados e tarefas vinculadas serão removidos permanentemente do banco de dados. Esta ação não pode ser desfeita.
            </p>
        </div>

        <button type="button"
                onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
                class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-sm transition cursor-pointer">
            Excluir minha conta
        </button>

        {{-- Modal de Confirmação de Exclusão --}}
        <div id="delete-account-modal"
             class="{{ $errors->userDeletion->isNotEmpty() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Confirmar exclusão da conta</h3>
                <p class="text-sm text-slate-600 mt-2">
                    Tem certeza que deseja excluir sua conta permanentemente? Digite sua senha atual para confirmar.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-5 space-y-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label for="delete_password" class="block text-sm font-medium text-slate-700 mb-1.5">Sua senha</label>
                        <input id="delete_password"
                               type="password"
                               name="password"
                               required
                               placeholder="Digite sua senha atual"
                               class="w-full rounded-xl border @if($errors->userDeletion->has('password')) border-rose-400 focus:ring-rose-500 @else border-slate-300 focus:ring-rose-500 @endif px-4 py-2.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:border-transparent transition">
                        @if ($errors->userDeletion->has('password'))
                            <p class="mt-1.5 text-xs text-rose-600">{{ $errors->userDeletion->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button"
                                onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                                class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 text-sm font-medium transition cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-sm transition cursor-pointer">
                            Sim, excluir conta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
