<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TaskFlow') — TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-slate-800 antialiased">

    {{-- Header / Navbar --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-indigo-600 text-white font-bold text-lg shadow-sm group-hover:bg-indigo-700 transition">
                        T
                    </span>
                    <div>
                        <span class="font-bold text-slate-900 text-lg tracking-tight">TaskFlow</span>
                        <span class="hidden sm:inline-block ml-1.5 text-xs font-medium px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700">
                            Laravel CRUD
                        </span>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden md:flex items-center gap-2">
                    @auth
                        <a href="{{ route('profile.show') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            Perfil
                        </a>

                        <a href="{{ route('tasks.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1.5 {{ request()->routeIs('tasks.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            <span>Tarefas</span>
                            <span class="text-[10px] uppercase tracking-wider font-semibold px-1.5 py-0.5 rounded bg-amber-100 text-amber-800">
                                CRUD 2
                            </span>
                        </a>

                        <div class="h-5 w-px bg-slate-200 mx-2"></div>

                        <span class="text-sm text-slate-500 mr-2">
                            Olá, <strong class="text-slate-800">{{ Auth::user()->name }}</strong>
                        </span>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-3.5 py-2 rounded-lg text-sm font-medium text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition cursor-pointer">
                                Sair
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('login') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            Entrar
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm transition">
                            Criar Conta
                        </a>
                    @endauth
                </nav>

                {{-- Mobile menu button --}}
                <button type="button"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none"
                        aria-label="Abrir menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white px-4 py-3 space-y-1">
            @auth
                <div class="px-3 py-2 text-xs font-medium text-slate-500 border-b border-slate-100 mb-2">
                    Conectado como <strong class="text-slate-800">{{ Auth::user()->name }}</strong>
                </div>
                <a href="{{ route('profile.show') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700 hover:bg-slate-100' }}">
                    Perfil
                </a>
                <a href="{{ route('tasks.index') }}"
                   class="flex items-center justify-between px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tasks.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700 hover:bg-slate-100' }}">
                    <span>Tarefas</span>
                    <span class="text-[10px] uppercase font-semibold px-1.5 py-0.5 rounded bg-amber-100 text-amber-800">CRUD 2</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="pt-1">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-rose-600 hover:bg-rose-50">
                        Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('login') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-700 hover:bg-slate-100' }}">
                    Entrar
                </a>
                <a href="{{ route('register') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white text-center">
                    Criar Conta
                </a>
            @endauth
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Flash Alerts --}}
        @if (session('success'))
            <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-sm text-emerald-800 shadow-sm" role="alert">
                <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3.5 text-sm text-rose-800 shadow-sm" role="alert">
                <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-slate-500">
            <p>
                <strong class="text-slate-700">TaskFlow</strong> — Atividade Prática em Laravel (Autenticação &amp; CRUD em Equipe)
            </p>
            <p>
                CRUD 1: Conta &amp; Autenticação &bull; CRUD 2: Tarefas
            </p>
        </div>
    </footer>

</body>
</html>
