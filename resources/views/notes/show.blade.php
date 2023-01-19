<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12 text-black w-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-100">     
            <div class="flex w-100">
                <p class="opacity-70"> <strong>Created: </strong> {{ $note->created_at->diffForHumans()}}</p>
                <p class="opacity-70 px-8"> <strong>Updated: </strong> {{ $note->updated_at->diffForHumans()}}</p>
            </div>      
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg"> 
                <a href="{{ route('notes.show',  $note->id)}}">
                <h2 class="font-bold text-4xl text-black">{{ $note->title }} </h2>
                </a>

                
                <p class="mt6 text-black whitespace-pre-wrap" text-black>{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
