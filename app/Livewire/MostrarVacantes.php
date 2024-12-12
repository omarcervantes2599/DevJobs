<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MostrarVacantes extends Component
{
    use AuthorizesRequests; // Asegúrate de incluir este trait
    protected $listeners = ['eliminarVacante'];
    public function eliminarVacante(Vacante $vacanteId)
    {
        // $this->authorize('delete', $vacanteId);
        $vacanteId->delete();

    }
    public function render()
    {
        $vacantes = Vacante::where('user_id', Auth::user()->id)->paginate(10);
        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
