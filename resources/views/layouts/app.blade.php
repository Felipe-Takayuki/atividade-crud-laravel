<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tasks') — Tasks</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen flex flex-col bg-[#f8f8f7] text-zinc-900 font-sans antialiased">

    <header class="bg-white border-b border-zinc-200 sticky top-0 z-30">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-14">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-zinc-900 hover:opacity-80 transition">
                    <svg class="w-5 h-5 text-zinc-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span class="font-semibold text-[15px] tracking-tight">Tasks</span>
                </a>

                <nav class="hidden md:flex items-center gap-1">
                    @auth
                        <a href="{{ route('profile.show') }}"
                           class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request()->routeIs('profile.*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50' }}">
                            Conta
                        </a>

                        <a href="{{ route('tasks.index') }}"
                           class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request()->routeIs('tasks.*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50' }}">
                            Tarefas
                        </a>

                        <div class="h-4 w-px bg-zinc-200 mx-2"></div>

                        <span class="text-sm text-zinc-500 mr-2">
                            {{ Auth::user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-1.5 rounded-md text-sm font-medium text-zinc-600 hover:text-red-600 hover:bg-red-50 transition cursor-pointer">
                                Sair
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-3 py-1.5 rounded-md text-sm font-medium transition {{ request()->routeIs('login') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-600 hover:text-zinc-900' }}">
                            Entrar
                        </a>
                        <a href="{{ route('register') }}"
                           class="ml-1 px-3.5 py-1.5 rounded-md text-sm font-medium bg-zinc-900 text-white hover:bg-zinc-800 transition">
                            Criar conta
                        </a>
                    @endauth
                </nav>

                <button type="button"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        class="md:hidden inline-flex items-center justify-center p-1.5 rounded-md text-zinc-600 hover:bg-zinc-100 focus:outline-none"
                        aria-label="Abrir menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden border-t border-zinc-200 bg-white px-4 py-3 space-y-1">
            @auth
                <div class="px-3 py-1.5 text-xs text-zinc-500 border-b border-zinc-100 mb-1.5">
                    {{ Auth::user()->name }}
                </div>
                <a href="{{ route('profile.show') }}"
                   class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('profile.*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    Conta
                </a>
                <a href="{{ route('tasks.index') }}"
                   class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('tasks.*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    Tarefas
                </a>
                <form method="POST" action="{{ route('logout') }}" class="pt-1">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-md text-sm font-medium text-red-600 hover:bg-red-50">
                        Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('login') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700 hover:bg-zinc-50' }}">
                    Entrar
                </a>
                <a href="{{ route('register') }}"
                   class="block px-3 py-2 rounded-md text-sm font-medium bg-zinc-900 text-white text-center">
                    Criar conta
                </a>
            @endauth
        </div>
    </header>

    <main class="flex-1 max-w-4xl w-full mx-auto px-4 sm:px-6 py-8">
        @if (session('success'))
            <div class="mb-6 flex items-center gap-2.5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="alert">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center gap-2.5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-zinc-200 mt-auto">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-zinc-400">
            <span>Tasks</span>
            <span>Laravel {{ app()->version() }}</span>
        </div>
    </footer>

</body>
</html>
