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
            @livewire('deudores-table')
        </div>

	</div>
</div>

@endsection