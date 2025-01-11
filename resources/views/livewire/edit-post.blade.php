<div>
    <a class="btn btn-green" wire:click="$set('open',true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar {{$post->title}}
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
            <x-button class="ml-2 mr-1" wire:click="save" wire:loading.attr="disabled" wire:target="save, image">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
