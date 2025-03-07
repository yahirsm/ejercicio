<div>
    <!-- Generar Token API -->
    <x-form-section submit="createApiToken">
        <x-slot name="title">
            {{ __('Crear Token API') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Los tokens API permiten que servicios de terceros se autentiquen con nuestra aplicación en tu nombre.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Nombre del Token -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Nombre del Token') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="createApiTokenForm.name" autofocus />
                <x-input-error for="name" class="mt-2" />
            </div>

            <!-- Permisos del Token -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <x-label for="permissions" value="{{ __('Permisos') }}" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <x-checkbox wire:model="createApiTokenForm.permissions" :value="$permission"/>
                                <span class="ms-2 text-sm text-gray-600">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="created">
                {{ __('Creado.') }}
            </x-action-message>

            <x-button>
                {{ __('Crear') }}
            </x-button>
        </x-slot>
    </x-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-section-border />

        <!-- Administrar Tokens API -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Administrar Tokens API') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Puedes eliminar cualquiera de tus tokens existentes si ya no los necesitas.') }}
                </x-slot>

                <!-- Lista de Tokens API -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div class="break-all">
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center ms-2">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Último uso') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ms-6 text-sm text-gray-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permisos') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Eliminar') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Modal de Valor del Token -->
    <x-dialog-modal wire:model.live="displayingToken">
        <x-slot name="title">
            {{ __('Token API') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('Por favor, copia tu nuevo token API. Por seguridad, no se mostrará nuevamente.') }}
            </div>

            <x-input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full break-all"
                autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Modal de Permisos del Token API -->
    <x-dialog-modal wire:model.live="managingApiTokenPermissions">
        <x-slot name="title">
            {{ __('Permisos del Token API') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <x-checkbox wire:model="updateApiTokenForm.permissions" :value="$permission"/>
                        <span class="ms-2 text-sm text-gray-600">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Modal de Confirmación para Eliminar Token -->
    <x-confirmation-modal wire:model.live="confirmingApiTokenDeletion">
        <x-slot name="title">
            {{ __('Eliminar Token API') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Estás seguro de que deseas eliminar este token API?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
