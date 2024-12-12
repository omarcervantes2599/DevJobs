<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;
    protected $rules = [
        'titulo' => 'required|string|min:6',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];
    public function crearVacante()
    {
        $datos = $this->validate();
        //almacenar la imagen
        // $imagen =  $this->imagen->store('public/vacantes'); //Almacena en storage/app/private/public/vacantes
        // $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        $imagen = $this->imagen->store('vacantes', 'public'); //Almacena explicitamente en /storage/app/public/vacantes
        $datos['imagen'] = basename($imagen); 
        //crear la vacante 
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => Auth::user()->id,
        ]);
        //crear un mensaje
        session()->flash('mensaje','La vacante se publico correctamente.');

        //redireccionar al usuario
        return redirect()->route('vacantes.index');
    }
    public function render()
    {   //Consultar BD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
