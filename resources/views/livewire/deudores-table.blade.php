<div class="container mx-auto p-4">
    <div wire:loading class="fixed inset-0  flex items-center justify-center">
        <span class="text-white">Cargando...</span>
    </div>

    <!-- Campo de búsqueda -->
    <div class="flex mb-4">
        <input wire:model="search" type="text" placeholder="Buscar..." class="w-full border border-slate-400 p-2 rounded focus:outline-blue-300">
        <button wire:click="searchDeudores" class="ml-2 px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700 cursor-pointer">
            Buscar
        </button>
    </div>

    @if (session('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div id="tableContainer" class="max-h-[60vh] overflow-y-auto bg-white  rounded-sm">
    {{-- <div id="tableContainer" class="max-h-[60vh] overflow-y-auto bg-white shadow-md rounded-lg" wire:scroll.debounce.300ms="loadMore"> --}}
        <table class="w-full border-collapse" id="deudoresTable">
            <thead>
                <tr class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                    <th class="p-2 font-normal"></th>
                    <th class="p-2 font-normal">RECURSO</th>
                    <th class="p-2 font-normal">IMPONIBLE</th>
                    <th class="p-2 font-normal">AÑO</th>
                    <th class="p-2 font-normal">CUOTA</th>
                    {{-- <th class="p-2 font-normal">M.T. ORIGEN</th>
                    <th class="p-2 font-normal">M.T. INTERES</th>
                    <th class="p-2 font-normal">M.T. DLNYF</th> --}}
                    <th class="p-2 font-normal">MONTO TOTAL</th>
                    <th class="p-2 font-normal">FECHA VTO.</th>
                    <th class="p-2 font-normal">SITUACIÓN</th>
                    <th class="p-2 font-normal">NRO. PLAN</th>
                    <th class="p-2 font-normal">ID GESTIÓN</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($deudores as $deudor)
                    @php
                        $rowId = "{$deudor->RECURSO}-{$deudor->IMPONIBLE}-{$deudor->ANIO}-{$deudor->CUOTA}-{$deudor->MONTO_TOTAL}";
                    @endphp
                    <tr wire:key="{{ $deudor->ID_GESTION ?? $loop->index }}" class="hover:bg-gray-100 border-1 border-b border-slate-200">
                        <td class="p-2 text-center">
                            <input  type="checkbox"
                                   class="rowCheckbox p-2 h-[20px]"
                                   data-id="{{ $rowId }}"
                                   data-imponible={{$deudor->IMPONIBLE}}
                                   data-anio={{$deudor->ANIO}}
                                   data-imponible={{$deudor->CUOTA}}
                                   {{ $deudor->ID_GESTION ? 'disabled' : '' }}>
                        </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->RECURSO}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->IMPONIBLE}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->ANIO}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->CUOTA}} </td>
                        {{-- <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->MONTO_TOTAL_ORIGEN}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->MONTO_TOTAL_INTERES}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->MONTO_TOTAL_DLNYF}} </td> --}}
                        <td class="p-2 border-slate-200 border-r border-l">$ {{ $deudor->MONTO_TOTAL}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->FECHA_VTO}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->SITUACION}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->NRO_PLAN}} </td>
                        <td class="p-2 border-slate-200 border-r border-l">{{ $deudor->ID_GESTION}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-end my-4">
        <button id="submitGestion" class="bg-slate-600 opacity-80 text-white p-4 rounded-md hover:opacity-100 cursor-pointer transition-all">Generar gestión de deuda</button>
    </div>
    <div class="mt-4 flex justify-between items-center">
        @if ($hasMore)
            <span id="loadingMore" class="text-gray-500">Cargando más...</span>
        @else
            <span id="noMore" class="text-gray-500">No hay más registros.</span>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        let selectedRows = new Set();

        const tableContainer = document.getElementById('tableContainer');
        const loadingMore = document.getElementById('loadingMore');
        let isLoading = false;

        if (!tableContainer || !loadingMore) {
            console.error('No se encontraron los elementos #tableContainer o #loadingMore');
            return;
        }

        // Escucha el evento emitido por Livewire
        Livewire.on('loadMoreFinished', () => {
            console.log('La carga ha terminado');
            isLoading = false;
            loadingMore.classList.add('hidden'); // Ocultamos el indicador de carga
        });

        tableContainer.addEventListener('scroll', function () {
            const scrollPosition = tableContainer.scrollTop + tableContainer.clientHeight;
            const bottom = tableContainer.scrollHeight;

            if (scrollPosition >= bottom - 50 && !isLoading && @json($hasMore)) {
                isLoading = true;
                loadingMore.classList.remove('hidden');
                Livewire.dispatch('loadMore'); // Llamamos al método loadMore

                // // También puedes desactivar el scroll temporalmente
                // setTimeout(() => {
                //     isLoading = false;
                // }, 1000); // Ajusta el tiempo según tu necesidad
            }
        });

        document.querySelectorAll('.rowCheckbox').forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                const id = checkbox.dataset.id;
                selectedRows.add(id);
            });
        });

        document.querySelector('#submitGestion').addEventListener('click', function () {
            const selectedData = Array.from(selectedRows).map(id => {
                const [recurso, imponible, anio, cuota, total] = id.split('-');
                return [recurso, imponible, anio, cuota, total]; // Devuelve un array con los 4 valores
            });

            fetch("{{ route('gdd.gestion.create') }}", { // Ajusta la ruta según tu backend
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ selected: selectedData }) // Envía el array de arrays
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                console.log('Datos enviados con éxito:', data);
                window.location.assign("/gdd/gestiones");
            })
            .catch(error => console.error('Error submitting data:', error));
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchDataAndInitializeTable();
        });

    });
</script>
@endpush
