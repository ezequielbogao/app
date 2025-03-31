<div class="w-2/12 justify-between md:px-5 border-r-1 border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 pb-32">
    <div class="flex flex-col mt-5">
        <x-gdd.menuBtn :to="'/gdd'" :titulo="'Inicio'">
            <x-slot:icon>
                <x-gdd.icons.casa width="24" height="24"/>
            </x-slot:icon>
        </x-gdd.menuBtn>

        <span class="w-full mb-10"></span>

        <x-gdd.menuBtn :to="'/gdd/deudores'" :titulo="'Deudores'">
            <x-slot:icon>
                <x-gdd.icons.deudor width="24" height="24"/>
            </x-slot:icon>
        </x-gdd.menuBtn>
        <x-gdd.menuBtn :to="'/gdd/gestiones'" :titulo="'Gestiones'">
            <x-slot:icon>
                <x-gdd.icons.caja width="24" height="24"/>
            </x-slot:icon>
        </x-gdd.menuBtn>
    </div>
</div>