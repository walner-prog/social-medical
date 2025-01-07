<div class="container">
    <div class="row mb-3">
        <div class="col-lg-3">
            <input type="text" wire:model="search" class="form-control" placeholder="Buscar por nombre, especialidad o ciudad...">
        </div>
        <div class="col-lg-2">
            <select wire:model="perPage" class="form-select">
                <option value="5">5 registros por página</option>
                <option value="10">10 registros por página</option>
                <option value="20">20 registros por página</option>
            </select>
        </div>
        <div class="col-lg-2 text-end">
            <button wire:click="openModal" class="btn btn-primary">Agregar Doctor</button>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th wire:click="sortBy('name')">Nombre</th>
                <th wire:click="sortBy('specialty')">Especialidad</th>
                <th wire:click="sortBy('city')">Ciudad</th>
                <th wire:click="sortBy('experience_years')">Años de Experiencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->especiality }}</td>
                    <td>{{ $doctor->city }}</td>
                    <td>{{ $doctor->experience_years }}</td>
                    <td>
                        <button wire:click="edit({{ $doctor->id }})" class="btn btn-sm btn-warning">Editar</button>
                        <button wire:click="delete({{ $doctor->id }})" class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay doctores registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <small>Mostrando {{ $doctores->firstItem() }} a {{ $doctores->lastItem() }} de un total de {{ $doctores->total() }} registros.</small>
        {{ $doctores->links() }}
    </div>

    
    @if($modalOpen)
        @include('livewire.partials.doctor-modal')
    @endif


    <div class="modal fade" id="doctorDetailModal" tabindex="-1" aria-labelledby="doctorDetailModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="doctorDetailModalLabel">Doctor Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($doctor)
                        <ul>
                            <li><strong>Name:</strong> {{ $doctor->name }}</li>
                            <li><strong>Specialty:</strong> {{ $doctor->specialty }}</li>
                            <li><strong>City:</strong> {{ $doctor->city }}</li>
                            <li><strong>Years of Experience:</strong> {{ $doctor->experience_years }}</li>
                            <li><strong>Email:</strong> {{ $doctor->email ?? 'Not provided' }}</li>
                            @if($doctor->phone)
                                <li><strong>Phone:</strong> {{ $doctor->phone }}</li>
                            @endif
                        </ul>
                    @else
                        <p>Doctor details not found.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteDoctorModal" tabindex="-1" aria-labelledby="confirmDeleteDoctorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteDoctorModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please type the doctor's name to confirm deletion:</p>
                    <p><strong>{{ $doctorName }}</strong></p>
                    <input type="text" id="confirmDoctorName" class="form-control" placeholder="Type the doctor's name here">
                    <div class="text-danger mt-2" id="error-message" style="display: none;">The name does not match, please try again.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteDoctorButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
    

</div>
