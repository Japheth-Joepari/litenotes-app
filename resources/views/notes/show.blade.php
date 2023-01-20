<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12 text-black w-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-100">
            @if(session('success')) 
                <div class="mb-4 px-4 py-2 bg-green border border-green-200 text-geen-700 rounded-md">
                    {{ session('success')}}
                </div>
            @endif   
            
            @if(!$note->trashed())
            <div class="flex w-100">
                <p class="opacity-70"> <strong>Created: </strong> {{ $note->created_at->diffForHumans()}}</p>
                <p class="opacity-70 px-8"> <strong>Updated: </strong> {{ $note->updated_at->diffForHumans()}}</p>
                <a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit Note</a>
                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @method("delete")
                    @csrf
                    <button class="btn btn-danger ml-4" type="submit" onclick="return confirm('Do you really want to delete this note ?')">Trash this Note ?</button>
                </form>
            </div>  
            @else
            <div class="flex w-100">
                <p class="opacity-70"> <strong>Created: </strong> {{ $note->created_at->diffForHumans()}}</p>
                <p class="opacity-70 px-8"> <strong>Updated: </strong> {{ $note->updated_at->diffForHumans()}}</p>
                <p class="opacity-70"> <strong>Deleted: </strong> {{ $note->deleted_at->diffForHumans()}}</p>

                <form action="{{ route('trashed.update', $note) }}" method="post">
                    @method("put")
                    <button class="btn-link ml-auto" type="submit">Restore Note</button>
                </form>

                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @method("delete")
                    @csrf
                    <button class="btn btn-danger ml-4" type="submit" onclick="return confirm('Do you really want to delete this note ?')">Permanently Delete ?</button>
                </form>
            </div> 
            @endif
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg"> 
                <h2 class="font-bold text-4xl text-black">{{ $note->title }} </h2>
                <p class="mt6 text-black whitespace-pre-wrap" text-black>{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
