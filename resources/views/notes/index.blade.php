<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">+ New Note</a>
            @forelse ($notes as $note) 
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg"> 
                <a href="{{ route('notes.show',  $note)}}">
                    <h2 class="font-bold text-2xl text-black">{{ $note->title }} </h2>
                </a>
                <p class="mt-2 text-black" text-black>{{ Str::limit($note->text, 200) }}</p>
                <span class="block mt-4 text-sm opacity-70 text-black">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
            @empty
            <p>You have no notes</p>
            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
