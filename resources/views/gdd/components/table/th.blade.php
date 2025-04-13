<th class="bg-slate-50 dark:bg-slate-700 p-3 border border-slate-200">
	@if($text)
		<span class="sm:block text-md font-normal leading-none text-slate-500 dark:text-slate-400 md:max-w-full max-w-[100px] abreviado">
			{{$text}}
		</span>
		@if($sm)
			<span class="block sm:hidden text-md font-normal leading-none text-slate-500 dark:text-slate-400 md:max-w-full max-w-[100px] abreviado">
				{{$sm}}
			</span>
		@endif
	@else
		{{$slot}}
	@endif
</th>