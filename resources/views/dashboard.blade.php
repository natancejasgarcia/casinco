<x-app-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const playLinks = document.querySelectorAll('.play-link');
    
    playLinks.forEach(link => {
        const originalText = link.textContent;
        const hoverText = link.getAttribute('data-text');
        
        link.addEventListener('mouseover', function() {
            link.textContent = hoverText;
        });
        
        link.addEventListener('mouseout', function() {
            link.textContent = originalText;
        });
    });
});
</script>

    <section class="mb-8 m-4">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Juegos Destacados</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Repetir este bloque para cada juego destacado -->
                    <div class="game-container bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden group hover:bg-green-100 cursor-pointer">
    <img src="{{ asset('images/pescador.webp') }}" alt="Lucky Fish Slots" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="text-2xl font-semibold">Lucky Fish Slots</h3>
        <p class="text-gray-600 dark:text-gray-300">Explora aguas místicas con Lucky Fish Slots, donde cada giro puede desbloquear tesoros submarinos y grandes victorias.</p>
    </div>
    <a href="#" class="play-link w-full block bg-green-500 text-white text-center py-2 hover:bg-green-700 transition-colors duration-300" data-text="Ganar ahora">Jugar</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden group hover:bg-green-200 cursor-pointer">
                        <img src="{{ asset('images/conejos.webp') }}" alt="Nombre del Juego" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-2xl font-semibold">Bunny Bonanza Slots</h3>
                            <p class="text-gray-600 dark:text-gray-300">Sigue a los conejos hacia fortunas escondidas y disfruta de una experiencia mágica de tragamonedas.</p>
                        </div>
                        <a href="#" class="play-link w-full block bg-green-500 text-white text-center py-2 hover:bg-green-700 transition-colors duration-300" data-text="Ganar ahora">Jugar</a>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden group hover:bg-green-200 cursor-pointer">
                        <img src="{{ asset('images/ruleta.webp') }}" alt="Nombre del Juego" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-2xl font-semibold">Ruleta Online</h3>
                            <p class="text-gray-600 dark:text-gray-300">Juega a la ruleta clasica, con muchisimos bonus , multiplicadores y regalos cada minuto</p>
                        </div>
                        <a href="#" class="play-link w-full block bg-green-500 text-white text-center py-2 hover:bg-green-700 transition-colors duration-300" data-text="Ganar ahora">Jugar</a>

                    </div>
                </div>
            </section>
</x-app-layout>
