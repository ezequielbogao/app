<div class="px-5 gap-5 flex align-middle items-center justify-between py-2 md:py-3 text-left border-b-2 border-slate-100 dark:border-slate-600 bg-white dark:bg-slate-700">
	<div class="flex align-middle items-center">
		{{-- <a href="/">
			{/* <img
				src={darkMode ? logo_white : logo_black}
				alt="Logo de la aplicación"
				class="me-5 w-14 md:w-20"
			/> */}
		</a> --}}
		<div class="flex flex-col">
			<span class="text-sm md:text-md text-slate-500 dark:text-slate-400 font-light">
				Gestión de Deuda
			</span>
			<span class="text-md md:text-lg text-slate-700 dark:text-slate-300 font-medium">
				GDD
			</span>
		</div>
	</div>
	<div class="flex gap-4">
		<a
			href="{{route('gdd.login')}}"
			class="p-2 rounded-full cursor-pointer bg-slate-50 text-slate-800 dark:text-yellow-300 hover:bg-slate-100 dark:bg-slate-800 hover:dark:bg-slate-600 border-none focus:outline-none">
			{{-- <Logout /> --}}
			Salir
		</a>
		<button
			id="toggleThme"
			{{-- onClick={toggleDarkMode} --}}
			class="p-2 rounded-full bg-slate-50 text-slate-800 dark:text-yellow-300 hover:bg-slate-100 dark:bg-slate-800 hover:dark:bg-slate-600 border-none focus:outline-none">
			<svg
			xmlns="http://www.w3.org/2000/svg"
			width="24"
			height="24"
			fill="none"
			stroke="currentColor"
			strokeWidth="1"
			strokeLinecap="round"
			strokeLinejoin="round"
			class="icon icon-tabler icons-tabler-outline icon-tabler-moon">
			<path
				stroke="none"
				d="M0 0h24v24H0z"
				fill="none"
			/>
			<path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
		</svg>
		</button>
	</div>
</div>


<script>
	let toggleBtn = document.querySelector('#toggleThme');

	toggleBtn.click(function(){
		document.documentElement.classList.add("dark");
		localStorage.setItem("darkMode", "true");
	})
</script>