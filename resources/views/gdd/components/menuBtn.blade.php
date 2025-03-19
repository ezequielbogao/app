<a href="{{ $to ?? '#' }}" class="mb-3 flex py-2 px-3 md:p-2 justify-center bg-slate-100 dark:bg-slate-600 md:justify-between md:items-center gap-3 transition-colors duration-300 ease-in-out hover:text-slate-700 hover:bg-slate-50 dark:hover:bg-slate-500 sm:rounded-none md:rounded-sm cursor-pointer">
	<div class="flex gap-2 align-middle items-center">
		{{$icon ?? ''}}
		<div class="content flex-col text-left hidden md:block">
			<span class="text-sm text-slate-400 font-light">
				{{$label ?? ''}}
			</span>
			<div class="flex justify-between">
				<span
					class="text-xs text-slate-500 font-bold dark:text-slate-100">
					{{$titulo ?? ''}}
				</span>
			</div>
		</div>
	</div>
	<span class="text-sm text-slate-600 dark:text-slate-100 hidden md:block">
		{{$contador ?? ''}}
	</span>
</a>