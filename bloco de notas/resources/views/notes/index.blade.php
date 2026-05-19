<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Minhas Notas') }}
            </h2>
            <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-950 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                + Nova Nota
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($notes->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                    Você ainda não criou nenhuma nota. Que tal começar agora?
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($notes as $note)
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-xl text-gray-900 mb-2 break-words">{{ $note->title }}</h3>
                                <p class="text-gray-600 text-sm whitespace-pre-line mb-4 break-words">{{ $note->content }}</p>
                            </div>
                            
                            <div class="mt-4 border-t pt-4">
                                <div class="text-xs text-gray-400 mb-3 space-y-1">
                                    <p>📅 Criada em: {{ $note->created_at->format('d/m/Y H:i') }}</p>
                                    <p>🔄 Modificada em: {{ $note->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div class="flex justify-end space-x-3 text-sm font-medium">
                                    <a href="{{ route('notes.edit', $note) }}" class="text-amber-600 hover:text-amber-900 bg-amber-50 px-3 py-1.5 rounded transition">Editar</a>
                                    
                                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta nota?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1.5 rounded transition">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>