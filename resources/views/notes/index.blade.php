<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Notes</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-lg font-medium">Notes</h3>
                <a href="{{ route('notes.create') }}" class="btn">+ New Note</a>
            </div>

            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                @forelse ($notes as $note)
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-lg">{{ $note->title }}</h4>
                                <p class="text-sm text-gray-600 mt-1 whitespace-pre-line">{{ \Illuminate\Support\Str::limit($note->content, 200) }}</p>
                                <p class="text-xs text-gray-400 mt-2">Created: {{ $note->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('notes.edit', $note) }}" class="px-3 py-1 border rounded text-sm bg-blue-300 text-blue-900 hover:bg-blue-400">Edit</a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 border rounded text-sm bg-red-300 text-red-900 hover:bg-red-400">Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="p-4">No notes yet. Create one!</div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $notes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
