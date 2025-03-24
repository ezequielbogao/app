<td class="p-2 border-1 border-slate-200 ">
	@if(isset($text))
		<span class="font-medium text-sm text-slate-600 dark:text-slate-200">
			{{$text}}
		</span>
	@else
		{{$slot}}
	@endif
</td>