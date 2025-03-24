import $ from 'jquery';
import 'datatables.net';

// function stylePagination() {
// 	$('#deudoresTable_paginate a').addClass('px-4 py-2 bg-slate-400 text-white rounded-lg hover:bg-slate-500');
// 	$('#deudoresTable_paginate .current').addClass('px-4 py-2 bg-blue-500 text-white rounded-lg');
// }

// function initializeDeudoresTable() {
// 	fetch(window.Laravel.tableDataUrl, {
// 		method: "POST",
// 		headers: {
// 			"Content-Type": "application/json",
// 			"X-CSRF-TOKEN": window.Laravel.csrfToken
// 		},
// 		body: JSON.stringify({ example: "data" })
// 	})
// 		.then(response => {
// 			if (!response.ok) {
// 				throw new Error(`HTTP error! status: ${response.status}`);
// 			}
// 			return response.json();
// 		})
// 		.then(data => {
// 			$('#deudoresTable').DataTable({
// 				responsive: true,
// 				data: data.data,
// 				language: {
// 					lengthMenu: "Mostrar _MENU_",
// 					search: "Buscar:",
// 					info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
// 					infoEmpty: "No hay registros disponibles",
// 					infoFiltered: "(filtrado de _MAX_ registros en total)",
// 					paginate: {
// 						first: "Primero",
// 						last: "Último",
// 						next: "Siguiente",
// 						previous: "Anterior"
// 					},
// 					zeroRecords: "No se encontraron resultados",
// 					emptyTable: "No hay datos disponibles en la tabla"
// 				},
// 				initComplete: function () {
// 					$('.ellipsis').addClass('px-4 py-2 bg-slate-400 text-white rounded-lg hover:bg-slate-500');
// 					$('#deudoresTable_filter').addClass('mb-4');
// 					$('#deudoresTable_filter label').addClass('flex flex-col');
// 					$('#deudoresTable_filter input').addClass('border-2 border-slate-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');

// 					$('#deudoresTable_info').addClass('my-2')

// 					$('#deudoresTable_paginate').addClass('block md:flex space-x-2 items-center justify-end');
// 					$('#deudoresTable_paginate a').addClass('px-4 py-2 bg-slate-400 text-white rounded-lg hover:bg-slate-500');
// 					$('#deudoresTable_paginate .current').addClass('px-4 py-2 bg-blue-500 text-white rounded-lg');

// 					$('#deudoresTable_length').addClass('flex justify-end');
// 					$('#deudoresTable_length label').addClass('flex flex-col');
// 					$('#deudoresTable_length select').addClass('border-2 border-slate-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500');
// 					stylePagination();
// 				},
// 				columns: [
// 					{ data: 'NRO_COMERCIO' },
// 					{ data: 'NOMBRE' },
// 					{ data: 'RUBRO' },
// 					{ data: 'CUIT' }
// 				],
// 				rowCallback: function (row, data, index) {
// 					$(row).addClass('bg-white border-1 border-slate-200 dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800');
// 					$(row).html(`
// 						<x-gdd.table.td content="${data.NRO_COMERCIO}"/>
// 						<x-gdd.table.td content="${data.NOMBRE}"/>
// 						<x-gdd.table.td content="${data.RUBRO}"/>
// 						<x-gdd.table.td content="${data.CUIT}"/>
// 					`);
// 				},
// 				paginate: {
// 					ellipsis: 'Más...'
// 				},
// 				drawCallback: function () {
// 					stylePagination();
// 					$('#loader').addClass('hidden');
// 					$('#deudoresTable').removeClass('hidden');
// 				}
// 			});
// 		})
// 		.catch(error => console.error('Error fetching data:', error));
// }

// document.addEventListener('DOMContentLoaded', initializeDeudoresTable);

// export default initializeDeudoresTable;