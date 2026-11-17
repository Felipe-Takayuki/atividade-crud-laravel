@extends('layouts.app')

@section('title', 'Editar Conta')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">
    <div class="flex items-center justify-between pb-4 border-b border-zinc-200">
        <div>
            <h1 class="text-xl font-semibold text-zinc-900 tracking-tight">Configurações da conta</h1>
            <p class="text-sm text-zinc-500 mt-0.5">Gerencie seus dados pessoais, senha e exclusão da conta.</p>
        </div>
        <a href="{{ route('profile.show') }}"
           class="text-sm font-medium text-zinc-600 hover:text-zinc-900 transition">
            &larr; Voltar
        </a>
    </div>

    <section class="bg-white rounded-lg border border-zinc-200 p-6">
        <div class="mb-5">
            <h2 class="text-base font-semibold text-zinc-900">Dados pessoais</h2>
            <p class="text-sm text-zinc-500">Atualize seu nome e endereço de e-mail.</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-zinc-700 mb-1">Nome</label>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       required
                       class="w-full rounded-md border @error('name') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">E-mail</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       required
                       class="w-full rounded-md border @error('email') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-1">
                <button type="submit"
                        class="px-4 py-2 rounded-md bg-zinc-900 hover:bg-zinc-800 text-white text-sm font-medium transition cursor-pointer">
                    Salvar alterações
                </button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-lg border border-zinc-200 p-6">
        <div class="mb-5">
            <h2 class="text-base font-semibold text-zinc-900">Alterar senha</h2>
            <p class="text-sm text-zinc-500">Informe sua senha atual antes de definir uma nova.</p>
        </div>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-zinc-700 mb-1">Senha atual</label>
                <input id="current_password"
                       type="password"
                       name="current_password"
                       required
                       autocomplete="current-password"
                       class="w-full rounded-md border @error('current_password') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">
                @error('current_password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-zinc-700 mb-1">Nova senha</label>
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
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 mb-1">Confirmar nova senha</label>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-900 transition">
            </div>

            <div class="pt-1">
                <button type="submit"
                        class="px-4 py-2 rounded-md bg-zinc-900 hover:bg-zinc-800 text-white text-sm font-medium transition cursor-pointer">
                    Atualizar senha
                </button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-lg border border-red-200 p-6">
        <div class="mb-4">
            <h2 class="text-base font-semibold text-red-700">Excluir conta</h2>
            <p class="text-sm text-zinc-600 mt-1">
                Todos os seus dados e tarefas vinculadas serão apagados permanentemente. Essa ação não pode ser desfeita.
            </p>
        </div>

        <button type="button"
                onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
                class="px-4 py-2 rounded-md border border-red-300 bg-white hover:bg-red-50 text-red-700 text-sm font-medium transition cursor-pointer">
            Excluir minha conta
        </button>

        <div id="delete-account-modal"
             class="{{ $errors->userDeletion->isNotEmpty() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center bg-zinc-950/50 p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6 border border-zinc-200 shadow-lg">
                <h3 class="text-base font-semibold text-zinc-900">Confirmar exclusão da conta</h3>
                <p class="text-sm text-zinc-600 mt-1.5">
                    Digite sua senha atual para confirmar a exclusão permanente da sua conta.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4 space-y-4">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label for="delete_password" class="block text-sm font-medium text-zinc-700 mb-1">Senha</label>
                        <input id="delete_password"
                               type="password"
                               name="password"
                               required
                               placeholder="Sua senha atual"
                               class="w-full rounded-md border @if($errors->userDeletion->has('password')) border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @endif px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">
                        @if ($errors->userDeletion->has('password'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->userDeletion->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button"
                                onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                                class="px-3.5 py-2 rounded-md border border-zinc-300 text-zinc-700 hover:bg-zinc-50 text-sm font-medium transition cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-3.5 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition cursor-pointer">
                            Excluir conta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
