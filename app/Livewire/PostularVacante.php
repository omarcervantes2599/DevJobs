<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];
    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }
    public function postularme()
    {
        $datos = $this->validate();
        //almacenar CV
        $cv = $this->cv->store('cv', 'public');
        $datos['cv'] = basename($cv);
        //crear el candidato ala bacante
        $this->vacante->candidatos()->create([
            'user_id' => Auth::user()->id,
            'cv' => $datos['cv']
        ]);
        // crear notificacion
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, Auth::user()->id));
        //mostrar mensaje
        session()->flash('mensaje', 'Se envio correctamente tu informacion');
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
