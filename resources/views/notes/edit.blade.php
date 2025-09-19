<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Note</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('notes.update', $note) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Title</label>
                        <input name="title" value="{{ old('title', $note->title) }}" maxlength="100" required class="w-full border rounded p-2" />
                        @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Content</label>
                        <textarea name="content" rows="8" required class="w-full border rounded p-2">{{ old('content', $note->content) }}</textarea>
                        @error('content') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex space-x-2">
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
                        <a href="{{ route('notes.index') }}" class="px-4 py-2 border rounded">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
