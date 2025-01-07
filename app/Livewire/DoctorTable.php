<?php
namespace App\Http\Livewire;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class DoctorTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $modalOpen = false;
    public $editMode = false;
    public $doctorId;
    public $name, $specialty, $city, $experience_years;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $selected = [];
    public $selectAll = false;
    public $doctor;
    public $doctorName;

    protected $rules = [
        'name' => 'required|string|max:255',
        'specialty' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'experience_years' => 'required|integer|min:0',
    ];

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->modalOpen = true;
    }

    public function edit($id)
    {
        $this->resetFields();
        $this->editMode = true;
        $doctor = Doctor::findOrFail($id);
        $this->doctorId = $doctor->id;
        $this->fill($doctor->toArray());
        $this->modalOpen = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'specialty' => $this->specialty,
            'city' => $this->city,
            'experience_years' => $this->experience_years,
        ];

        if ($this->editMode) {
            Doctor::findOrFail($this->doctorId)->update($data);
        } else {
            Doctor::create($data);
        }

        $this->modalOpen = false;
        $this->resetFields();
    }

    public function delete($id)
    {
        Doctor::findOrFail($id)->delete();
    }

    public function showDoctorDetails($id)
{
    $this->doctor = Doctor::findOrFail($id);
}

public function openDeleteModal($id)
{
    $doctor = Doctor::findOrFail($id);
    $this->doctorName = $doctor->name;
}

    public function resetFields()
    {
        $this->editMode = false;
        $this->doctorId = null;
        $this->name = '';
        $this->specialty = '';
        $this->city = '';
        $this->experience_years = '';
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $doctors = Doctor::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('specialty', 'like', "%{$this->search}%")
            ->orWhere('city', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    
            dd($doctors); 
        return view('livewire.doctor-table', compact('doctors'));
    }
    
}
