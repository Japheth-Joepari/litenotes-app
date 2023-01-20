<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) 
                <div class="mb-4 px-4 py-2 bg-green border border-green-200 text-geen-700 rounded-md">
                    {{ session('success')}}
                </div>
            @endif 

            @if(request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">+ New Note</a>
                    @else
                @foreach($notes as $note)
                    <p class="opacity-70 px-8"> <strong>Deleted: </strong> {{ $note->deleted_at->diffForHumans()}}</p>
                @endforeach
            @endif
            
            @forelse ($notes as $note) 
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg"> 
                <a 
                @if(request()->routeIs('notes.index'))
                            href="{{ route('notes.show', $note) }}"
                        @else
                            href="{{ route('trash.show', $note) }}"
                        @endif
                >
                    <h2 class="font-bold text-2xl text-black">{{ $note->title }} </h2>
                </a>
                <p class="mt-2 text-black" text-black>{{ Str::limit($note->text, 200) }}</p>
                <span class="block mt-4 text-sm opacity-70 text-black">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
            @empty
            @if(request()->routeIs('notes.index'))
                <p>You have no notes</p>
            @else
                <p>Your trash folder is Empty</p>
            @endif
            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
