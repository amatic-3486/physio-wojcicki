/** Build: tailwindcss -c tailwind.config.js -i assets/css/tailwind-input.css -o assets/css/tailwind.css --minify */
module.exports = {
	content: ['./*.php', './inc/**/*.php', './assets/js/**/*.js'],
	theme: {
		extend: {
			colors: {
				accent: { DEFAULT: '#C85A32', dark: '#BD4F28' },
				secondary: { DEFAULT: '#1E4355', dark: '#163342' },
				cream: '#F9F6F0',
				mint: '#E8F2F4',
			},
			fontFamily: {
				serif: ['Playfair Display', 'serif'],
				sans: ['Inter', 'sans-serif'],
				script: ['Caveat', 'cursive'],
			},
		},
	},
};
