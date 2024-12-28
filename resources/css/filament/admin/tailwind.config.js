import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: 'class', // atau 'media' jika Anda ingin otomatis mengikuti pengaturan sistem
    theme: {
        extend: {
        colors: {
            // Anda dapat menambahkan warna khusus untuk mode gelap di sini
            sidebar: {
            light: 'rgb(255, 255, 255)', // Light mode
            dark: 'rgb(17 24 39)', // Dark mode
            },
        },
        },
    },
    plugins: [],

}
