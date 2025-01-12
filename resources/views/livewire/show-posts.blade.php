<div>
    <!--wire:init="loadPosts"-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="px-6 py-3 flex items-center">
            <div class="flex items-center">
                <x-label>Mostrar</x-label>
                <x-select wire:model="cant" class="mx-2">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </x-select>
                <x-label>entradas</x-label>
            </div>
            <x-input type="text" class="flex-1 mx-4" wire:model="search" wire:keydown="mostrar"
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
                @forelse($posts as $item)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$item->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$item->title}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->content}}
                        </td>
                        <td class="px-6 py-4">
                            <a class="btn btn-green" wire:click="edit({{$item}})">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <td colspan="5" class="px-3 py-2">
                        <span class="px-3 py-2 text-red-500">
                        No existen registros o coincidencias de búsqueda
                        </span>
                    </td>
                @endforelse
            </x-slot>
        </x-table>
        @if(count($posts))
            <tr>
                @if($posts->hasPages())
                    <div class="px-6 py-3">
                        {{$posts->links()}}
                    </div>
                @endif
            </tr>
        @endif
    </div>

    <x-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar
        </x-slot>
        <x-slot name="content">
            <div wire:loading wire:target="image"
                 class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                 role="alert">
                <span class="font-medium">Cargando imagen</span> Espere hasta que la imagen se haya cargado...
            </div>
            @if($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">
            @else
                <img src="{{Storage::url($post->image)}}" alt="">
            @endif
            <div class="mb-4">
                <x-label value="Título"/>
                <x-input wire:model="postEdit.title" class="w-full"/>
                <x-input-error for="postEdit.title"/>
            </div>
            <div class="mb-4">
                <x-label value="Contenido"/>
                <x-textarea wire:model="postEdit.content" class="w-full"/>
                <x-input-error for="postEdit.content"/>
            </div>
            <div class="mb-4">
                <input type="file" wire:model="image">
                <x-input-error for="image"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2 mr-1" wire:click="saveUpdate" wire:loading.attr="disabled" wire:target="save, image">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
