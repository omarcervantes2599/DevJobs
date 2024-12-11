<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500 ">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/y') }}</p>
                </div>
                <div class="flex  flex-col md:flex-row gap-3 items-stretch mt-5 md:mt-0 text-center">
                    <a href="" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                        Candidatos
                    </a>
                    <a href="" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                        Editar
                    </a>
                    <a href="" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                        Eliminar
                    </a>
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
