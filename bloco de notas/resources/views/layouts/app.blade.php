<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloco de Notas Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('notes.index') }}" class="text-xl font-bold text-indigo-600">🔐 NotasSeguras</a>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 font-medium">Olá, {{ Auth::user()->name }}</span>
                <a href="{{ route('notes.trash') }}" class="text-gray-500 hover:text-red-500">🗑️ Lixeira</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- O conteúdo das outras páginas entra aqui -->
        @yield('content')
    </main>
</body>
</html>