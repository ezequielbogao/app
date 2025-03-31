@extends('gdd.layouts.main')
@section('title', 'Gestión - Editar')
@section('content')

<div class="w-full flex h-full min-h-screen bg-white ">

    <div class="text-left w-full">
		<div class="p-3 px-5 text-left border-b-2 border-slate-100 dark:border-slate-600 bg-white dark:bg-slate-700 flex justify-between">
            <div class="flex flex-col text-left">
                <span class="text-md text-slate-400 font-light">
                    GDD
                </span>
                <span class="text-2xl text-slate-700 dark:text-slate-300 font-medium">
                    Gestión <span class="text-slate-500">#{{$resource->id}}</span>
                </span>
            </div>
            <div class="flex items-center align-center sm:mr-20 md:mr-2">
				<a class="p-2 px-3 rounded-md bg-trasparent text-slate-600 outline-none focus:outline-none text-sm">
					<x-gdd.icons.Tablefilter width="24" height="24"/>
				</a>
            </div>
        </div>


        <div class="overflow-auto bg-white dark:bg-slate-800 mt-5 border-slate-100 dark:border-slate-700 p-4">
            <form
            class="mt-4 space-y-4">
            <div>
                <label
                    htmlFor="username"
                    class="block text-slate-700 dark:text-slate-300">
                    N° Gestión
                </label>
                    <span class="w-full px-4 py-2 border border-slate-200 rounded-md text-slate-700 bg-white dark:bg-slate-700 dark:text-slate-50 focus:outline-none">{{$resource->id}}</span>
            </div>
            <div>
                <label
                    htmlFor="username"
                    class="block text-slate-700 dark:text-slate-300">
                    Recurso
                </label>
                    <span class="w-full px-4 py-2 border border-slate-200 rounded-md text-slate-700 bg-white dark:bg-slate-700 dark:text-slate-50 focus:outline-none">{{$resource->RECURSO}}</span>
            </div>
            <div class="flex justify-end">
                <a href="{{route('gdd.dashboard')}}"
                    type="submit"
                    class="w-auto p-2 text-center bg-slate-800 text-white rounded-md hover:bg-slate-700 border-none focus:outline-none">
                    Ingresar
                </a>
            </div>
        </form>
        </div>

	</div>
</div>
@endsection