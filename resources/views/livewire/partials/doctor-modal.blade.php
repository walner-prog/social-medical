<div class="modal d-block" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-white">{{ $editMode ? 'Editar Doctor' : 'Agregar Doctor' }}</h3>
                <button type="button" wire:click="$set('modalOpen', false)" class="btn-close"></button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nombre" class="form-control" placeholder="Nombre del doctor">
                                @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Especialidad <span class="text-danger">*</span></label>
                                <select wire:model="especialidad" class="form-control">
                                    <option value="">Seleccione una especialidad</option>
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{ $especialidad }}">{{ $especialidad }}</option>
                                    @endforeach
                                </select>
                                @error('especialidad') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Ciudad <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="text" wire:model="searchCiudad" class="form-control" placeholder="Buscar ciudad...">
                                    @if(!empty($ciudadesFiltradas))
                                        <div class="list-group position-absolute w-100 shadow-sm" style="z-index: 1050;">
                                            @foreach($ciudadesFiltradas as $ciudad)
                                                <button type="button" 
                                                        wire:click="selectCiudad('{{ $ciudad }}')" 
                                                        class="list-group-item list-group-item-action">
                                                    {{ $ciudad }}
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                @error('ciudad') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Años de experiencia <span class="text-danger">*</span></label>
                                <input type="number" wire:model="anios_experiencia" class="form-control" min="0" placeholder="Años de experiencia">
                                @error('anios_experiencia') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Correo electrónico <span class="text-danger">*</span></label>
                                <input type="email" wire:model="correo" class="form-control" placeholder="Correo del doctor">
                                @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('modalOpen', false)" class="bt-cerrar">Cerrar</button>
                    <button type="submit" class="bt-primario">{{ $editMode ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
