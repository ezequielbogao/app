@extends('gdd.layouts.main')
@section('title', 'Gestión')
@section('content')

<div class="w-full flex h-full min-h-screen bg-white ">

    <div class="text-left w-full">
		<div class="p-3 px-5 text-left border-b-2 border-slate-100 dark:border-slate-600 bg-white dark:bg-slate-700 flex justify-between">
            <div class="flex flex-col text-left">
                <span class="text-md text-slate-400 font-light">
                    GDD
                </span>
                <span class="text-2xl text-slate-700 dark:text-slate-300 font-medium">
                    Gestión
                </span>
            </div>
            <div class="flex items-center align-center sm:mr-20 md:mr-2">
				<a class="p-2 px-3 rounded-md bg-trasparent text-slate-600 outline-none focus:outline-none text-sm">
					<x-gdd.icons.Tablefilter width="24" height="24"/>
				</a>
            </div>
        </div>


        <div class="overflow-auto bg-white dark:bg-slate-800 mt-5 border-slate-100 dark:border-slate-700 p-4">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            @endif
            <table id="gestionTable" class="gdd-table min-w-full table-auto w-full text-left p-3">
                <thead class=" text-slate-600">
                    <tr class="bg-white border-b-1 border-slate-200 dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800">
                        <x-gdd.table.th text="ID" sm="#"/>
                        <x-gdd.table.th text="RECURSO" sm="REC" />
                        <x-gdd.table.th text="NRO_IMPONIBLE" sm="NRO"/>
                        <x-gdd.table.th text="PERIODOS" sm="PERIODOS"/>
                        <x-gdd.table.th text="MONTO_TOTAL" sm="TOTAL"/>
                        <x-gdd.table.th text="INICIO" sm="INI"/>
                        <x-gdd.table.th text="FINALIZACION" sm="FIN" />
                        <x-gdd.table.th text="ESTADO" sm="EST"/>
                        <x-gdd.table.th text="OBSERVACION" sm="OBS" />
                        <x-gdd.table.th text="OPCIONES" sm="OPS" />
                    </tr>
                </thead>
                <tbody class="text-gray-700 p-3">
                    @foreach($resource as $gestion)
                        <tr class="bg-white border-b-1 border-slate-200 dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800">
                            <x-gdd.table.td text="{{ $gestion->id }}" />
                            <x-gdd.table.td text="{{ $gestion->RECURSO }}" />
                            <x-gdd.table.td text="{{ $gestion->NRO_IMPONIBLE }}" />
                            <x-gdd.table.td text="{{ $gestion->PERIODOS }}" />
                            <x-gdd.table.td text="{{ $gestion->MONTO_TOTAL }}" />
                            <x-gdd.table.td text="{{ $gestion->created_at->format('d-m-Y') }}" />
                            <x-gdd.table.td text="{{ $gestion->FINALIZACION ? $gestion->FINALIZACION->format('d-m-Y') : '-' }}" />
                            <x-gdd.table.td text="{{ $gestion->ESTADO }}" />
                            <x-gdd.table.td text="{{ $gestion->OBSERVACION }}" />
                            <x-gdd.table.td>
                                <a href="{{route('gdd.gestiones.edit',['id' => $gestion->id])}}" class="text-slate-400 justify-center items-center hover:bg-slate-200 p-2 rounded-2xl cursor-pointer w-auto flex">
                                    <x-gdd.icons.edit/>
                                </a>
                            </x-gdd.table.td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-end">
                <button id="submitSelected" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 hidden">Generar gestión</button>
            </div>
        </div>

	</div>
</div>
@endsection