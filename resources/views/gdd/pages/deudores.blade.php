@extends('gdd.layouts.main')
@section('title', 'Deudores')
@section('content')

<div class="w-full flex h-full min-h-screen bg-white ">

    <div class="text-left w-full">
		<div class="p-3 px-5 text-left border-b-2 border-slate-100 dark:border-slate-600 bg-white dark:bg-slate-700 flex justify-between">
            <div class="flex flex-col text-left">
                <span class="text-xs text-slate-400 font-light">
                    GDD
                </span>
                <span class="sm:text-xl md:text-2xl text-slate-700 dark:text-slate-300 font-medium">
                    Deudores
                </span>
            </div>
            <div class="flex items-center align-center sm:mr-20 md:mr-2">
				<a class="p-2 px-3 rounded-md bg-trasparent text-slate-600 outline-none focus:outline-none text-sm">
					<x-gdd.icons.Tablefilter width="24" height="24"/>
				</a>
            </div>
        </div>

        <div class="overflow-auto bg-white dark:bg-slate-800 mt-5 border-slate-100 dark:border-slate-700 p-4">
            <div id="loader" class="flex justify-center items-center h-32">
                <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
            <table id="deudoresTable" class="gdd-table min-w-full table-auto w-full text-left p-3 hidden">
                <thead class=" text-slate-600">
                    <tr class="bg-white border-b-1 border-slate-200 dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800">
                        <x-gdd.table.th text=""/>
                        <x-gdd.table.th text="RECURSO" />
                        <x-gdd.table.th text="NRO_IMPONIBLE" />
                        <x-gdd.table.th text="CUOTA" />
                        <x-gdd.table.th text="ANIO" />
                        <x-gdd.table.th text="MONTO_TOTAL" />
                        <x-gdd.table.th text="FECHA_VTO" />
                        <x-gdd.table.th text="SITUACION" />
                        <x-gdd.table.th text="ESTADO" />
                    </tr>
                </thead>
                <tbody class="text-gray-700 p-3"></tbody>
            </table>
            <div class="flex justify-end">
                <button id="submitSelected" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 hidden">Generar gestión</button>
            </div>
        </div>

	</div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/jqueryDataTables.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('datatable/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('datatable/jqueryDataTables.min.js') }}"></script>

    <script>
        // Almacenar los IDs seleccionados
        let selectedRows = new Set();

        function fetchDataAndInitializeTable() {
            fetch("{{ route('deudor.data') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ example: "data" }) // Esto se ajustará si necesitas enviar datos iniciales
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                $('#deudoresTable').DataTable({
                    responsive: true,
                    data: data.data,
                    language: {
                        lengthMenu: "Mostrar _MENU_",
                        search: "Buscar:",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "No hay registros disponibles",
                        infoFiltered: "(filtrado de _MAX_ registros en total)",
                        paginate: {
                            first: "Primero",
                            last: "Último",
                            next: "Siguiente",
                            previous: "Anterior"
                        },
                        zeroRecords: "No se encontraron resultados",
                        emptyTable: "No hay datos disponibles en la tabla"
                    },
                    initComplete: function () {
                        $('#deudoresTable_filter').addClass('mb-4');
                        $('#deudoresTable_filter label').addClass('flex flex-col');
                        $('#deudoresTable_filter input').addClass('border-2 border-slate-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');
                        $('#deudoresTable_info').addClass('my-2');
                        $('#deudoresTable_paginate').addClass('block md:flex space-x-2 items-center justify-end');
                        $('#deudoresTable_length').addClass('flex justify-end');
                        $('#deudoresTable_length label').addClass('flex flex-col');
                        $('#deudoresTable_length select').addClass('border-2 border-slate-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');
                        stylePagination();
                    },
                    columns: [
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            width: "1%",
                            className: "text-center",
                            render: function (data, type, row) {
                                const id = `${row.RECURSO}-${row.NRO_IMPONIBLE}-${row.ANIO}-${row.CUOTA}-${row.MONTO_TOTAL}`;
                                return `<input type="checkbox" class="checkbox" ${row.GESTION_ID ? 'disabled' : '' }  data-id="${id}"
                                    ${selectedRows.has(id) ? 'checked' : ''}>`;
                            }
                        },
                        { data: 'RECURSO', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'NRO_IMPONIBLE', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'CUOTA', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'ANIO', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'MONTO_TOTAL', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'FECHA_VTO', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'SITUACION', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                        { data: 'ESTADO', render: data => `<span class="font-medium text-sm text-slate-600 dark:text-slate-200">${data}</span>` },
                    ],
                    rowCallback: function(row) {
                        $(row).addClass('bg-white border-1 border-slate-200 dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800');
                    },
                    drawCallback: function () {
                        stylePagination();
                        $('.checkbox').off('change').on('change', function () {
                            const id = $(this).data('id');
                            if (this.checked) {
                                selectedRows.add(id);
                            } else {
                                selectedRows.delete(id);
                            }
                        });
                        $('#loader').addClass('hidden');
                        $('#deudoresTable').removeClass('hidden');
                        $('#submitSelected').removeClass('hidden');
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        }

        function stylePagination() {
            $('#deudoresTable_paginate a').addClass('px-4 py-2 bg-slate-400 text-white rounded-lg hover:bg-slate-500');
            $('#deudoresTable_paginate .current').addClass('px-4 py-2 bg-blue-500 text-white rounded-lg');
            $('.ellipsis').addClass('px-4 py-2 bg-slate-400 text-white rounded-lg hover:bg-slate-500');
        }

        // Función para enviar los datos seleccionados por POST
        $('#submitSelected').on('click', function () {
            const selectedData = Array.from(selectedRows).map(id => {
                const [recurso, nro, anio, cuota, total] = id.split('-');
                return [recurso, nro, anio, cuota, total]; // Devuelve un array con los 4 valores
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
                window.location.assign("/gdd/gestion");
            })
            .catch(error => console.error('Error submitting data:', error));
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchDataAndInitializeTable();
        });
    </script>
@endpush
