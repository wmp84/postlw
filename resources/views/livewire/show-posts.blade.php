<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="px-6 py-3 flex items-center">
            <x-input type="text" class="flex-1 mr-4" wire:model="search" wire:keydown="mostrar"
                     placeholder="Realizar búsqueda..."/>
            @livewire('create-post')
        </div>
        <x-table>
            <x-slot name="head">
                <tr>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('id')">
                        ID
                        @if($sort == 'id')
                            @if($direction=='asc')
                                <i class="fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-solid fa-sort-down"></i>
                            @endif
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('title')">
                        Título
                        @if($sort == 'title')
                            @if($direction=='asc')
                                <i class="fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-solid fa-sort-down"></i>
                            @endif
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th scope="col" class="cursor-pointer px-6 py-3" wire:click="order('content')">
                        Contenido
                        @if($sort == 'content')
                            @if($direction=='asc')
                                <i class="fa-solid fa-sort-up"></i>
                            @else
                                <i class="fa-solid fa-sort-down"></i>
                            @endif
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acción
                    </th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @forelse($posts as $post)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$post->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$post->title}}
                        </td>
                        <td class="px-6 py-4">
                            {{$post->content}}
                        </td>
                        <td class="px-6 py-4">
                            @livewire('edit-post', ['post'=>$post], key($post->id))
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="px-3 py-2">
                        <span class="px-3 py-2 text-red-500">
                        No exiten registro o coincidencias de búsqueda
                        </span>
                    </td>
                @endforelse
            </x-slot>
        </x-table>
    </div>
</div>
