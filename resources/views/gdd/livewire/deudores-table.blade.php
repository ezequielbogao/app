<div class="container mx-auto p-4">
    <div wire:loading class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center">
        <span class="text-white">Cargando...</span>
    </div>
    <input wire:model.debounce.500ms="search" type="text" placeholder="Buscar..." class="w-full border p-2 rounded mb-4">
    @if (session('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
    <table class="w-full border-collapse bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2"></th>
                <th class="p-2">RECURSO</th>
                <th class="p-2">IMPONIBLE</th>
                <th class="p-2">ANIO</th>
                <th class="p-2">CUOTA</th>
                <th class="p-2">TOTAL ORIGEN</th>
                <th class="p-2">TOTAL INTERES</th>
                <th class="p-2">TOTAL DLNYF</th>
                <th class="p-2">TOTAL</th>
                <th class="p-2">FECHA VTO</th>
                <th class="p-2">SITUACION</th>
                <th class="p-2">PLAN</th>
                <th class="p-2">ID_GESTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deudores as $deudor)
                @php
                    $rowId = "{$deudor->RECURSO}-{$deudor->IMPONIBLE}-{$deudor->ANIO}-{$deudor->CUOTA}-{$deudor->MONTO_TOTAL}";
                @endphp
                <tr wire:key="{{ $deudor->ID_GESTION }}">
                    <td class="p-2 text-center">
                        <input type="checkbox"
                               wire:model="selectedRows"
                               value="{{ $rowId }}">
                    </td>
                    <td class="p-2" >{{ $deudor->RECURSO }} </td>
                    <td class="p-2" >{{ $deudor->IMPONIBLE }} </td>
                    <td class="p-2" >{{ $deudor->ANIO }} </td>
                    <td class="p-2" >{{ $deudor->CUOTA }} </td>
                    <td class="p-2" >{{ $deudor->MONTO_TOTAL_ORIGEN }} </td>
                    <td class="p-2" >{{ $deudor->MONTO_TOTAL_INTERES }} </td>
                    <td class="p-2" >{{ $deudor->MONTO_TOTAL_DLNYF }} </td>
                    <td class="p-2" >{{ $deudor->MONTO_TOTAL }} </td>
                    <td class="p-2" >{{ $deudor->FECHA_VTO }} </td>
                    <td class="p-2" >{{ $deudor->SITUACION }} </td>
                    <td class="p-2" >{{ $deudor->NRO_PLAN }} </td>
                    <td class="p-2" >{{ $deudor->ID_GESTION }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 flex justify-between items-center">
        {{ $deudores->links() }}
        {{-- @if (!empty($selectedRows))
            <button wire:click="submitSelected" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Enviar Seleccionados ({{ count($selectedRows) }})
            </button>
        @endif --}}
    </div>
</div>