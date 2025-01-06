<div>
    <x-button wire:click="$set('open',true)">
        Crear post
    </x-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>
        <x-slot name="content">
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
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2 mr-1" wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
