<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500 ">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/y') }}</p>
                </div>
                <div class="flex  flex-col md:flex-row gap-3 items-stretch mt-5 md:mt-0 text-center">
                    <a href="" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                        Candidatos
                    </a>
                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                        Editar
                    </a>
                    <button onclick="confirmarEliminacion({{ $vacante->id }})"
                        class="bg-red-600 rounded-lg px-4 text-white text-xs font-bold py-2 text-center">
                        Eliminar
                    </button>

                </div>
            </div>
        @empty
            <p>No hay vacantes disponibles</p>
        @endforelse
    </div>
    <div class="flex justify-center mt-10">
        {{ $vacantes->links() }}
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarEliminacion(vacanteId) {
            Swal.fire({
                title: "¿Eliminar vacante?",
                text: "Una vacante eliminada no se puede recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarVacante', [vacanteId]);
                    Swal.fire({
                        title: "¡Vacante eliminada!",
                        text: "Eliminada correctamente.",
                        icon: "success",
                    });
                }
            });
        }
    </script>
@endpush
