<th class="bg-slate-50 dark:bg-slate-700 p-3 border border-slate-200">
	@if(isset($text))
		<span class="hidden sm:block text-md font-normal leading-none text-slate-500 dark:text-slate-400 md:max-w-full max-w-[100px] truncate">
			{{$text}}
		</span>
		@if(isset($sm))
			<span class="block sm:hidden text-md font-normal leading-none text-slate-500 dark:text-slate-400 md:max-w-full max-w-[100px] truncate">
				{{$sm}}
			</span>
		@endif
	@else
		{{$slot}}
	@endif
</th>