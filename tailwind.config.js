// tailwind.config.js
module.exports = {
	darkMode: 'class', // Usar la clase 'dark' para activar el dark mode
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
		'./resources/**/*.tsx', // Si usas React o TypeScript
	],
	theme: {
		extend: {},
	},
	plugins: [],
}