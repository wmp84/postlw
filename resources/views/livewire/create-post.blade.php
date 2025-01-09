<div>
    <x-button wire:click="$set('open',true)">
        Crear post
    </x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>
        <x-slot name="content">
            <div wire:loading wire:target="image" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Cargando imagen</span> Espere hasta que la imagen se haya cargado...
            </div>
            @if($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">
            @endif
            <div class="mb-4">
                <x-label value="Título del post"/>
                <x-input type="text" class="w-full" wire:model="title"/>
                <x-input-error for="title"/>
            </div>
            <div class="mb-4">
                <x-label value="Descripción"/>
                <x-textarea type="textarea" class="w-full" wire:model.defer="content"/>
                <x-input-error for="content"/>
            </div>
            <div>
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-input-error for="image"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2 mr-1" wire:click="save" wire:loading.attr="disabled" wire:target="save, image">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
