<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Juego de Casino</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="min-h-screen bg-green-100 dark:bg-black dark:text-white/50">
        <header class="bg-green-500 rounded-b-lg shadow-md py-4 px-4">
            <div class="container mx-auto flex justify-between items-center text-center">
                <div class="flex-1"></div> <!-- Espaciador a la izquierda -->
                <!-- Alpine.js desde un CDN -->
                <script src="//unpkg.com/alpinejs" defer></script>

                <!-- Logo en el centro -->
                <div class="flex-1">
                    <img src="{{ asset('images/conejologo.png') }}" alt="Logo del Casino" class="mx-auto" style="height: 130px; width: auto;"> <!-- Ajusta las dimensiones según sea necesario -->
                </div>

                <!-- Navegación y enlaces de autenticación a la derecha -->
                <nav class="flex gap-4 flex-1 justify-end">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-2 shadow-sm">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-800 bg-white hover:bg-gray-100 rounded-md px-3 py-2 shadow-sm">Iniciar sesión</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-gray-800 bg-white hover:bg-gray-100 rounded-md px-3 py-2 shadow-sm">Regístrate</a>
                    @endif
                    @endauth
                </nav>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
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



        <!-- Sección principal -->
        <main class="container mx-auto px-4 py-8">
            <section class="text-center mb-8">
                <h1 class="text-4xl font-bold text-green-800 dark:text-white mb-4">Bienvenido a Nuestro Casino Online</h1>
                <p class="text-xl text-gray-600 dark:text-gray-300">Disfruta de la mejor experiencia de juegos de casino desde la comodidad de tu casa.</p>
            </section>

            <!-- Juegos destacados -->
            <section class="mb-8">
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
                            <p class="text-gray-600 dark:text-gray-300">Juega a la ruleta clasica, con muchisimos bonus y regalos cada minuto</p>
                        </div>
                        <a href="#" class="play-link w-full block bg-green-500 text-white text-center py-2 hover:bg-green-700 transition-colors duration-300" data-text="Ganar ahora">Jugar</a>

                    </div>
                </div>
            </section>

            <!-- Promociones -->
            <section class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center dark:text-white mb-6">Promociones Actuales</h2>
                <!-- Contenido de las promociones aquí -->
                <div x-data="carousel()" x-init="startRotation()" class="relative w-full overflow-hidden" style="max-width: 768px; margin: auto;">
                    <div class="flex whitespace-nowrap transition-transform ease-linear" x-ref="carousel" :style="'transform: translateX(-' + currentIndex * 100 + '%);'">
                        <!-- Asegúrate de cambiar los URLs de las imágenes a las de tus promociones -->
                        <div class="w-full flex-none bg-green-200" style="height: 300px; background-image: url('{{ asset('images/promo1.webp') }}'); background-size: cover;" x-text="'Promoción 1'"></div>
                        <div class="w-full flex-none bg-green-300" style="height: 300px; background-image: url('{{ asset('images/promo2.webp') }}'); background-size: cover;" x-text="'Promoción 2'"></div>
                        <div class="w-full flex-none bg-green-400" style="height: 300px; background-image: url('{{ asset('images/promo3.webp') }}'); background-size: cover;" x-text="'Promoción 3'"></div>
                    </div>
                    <button @click="move(-1)" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-4 rounded-full hover:bg-green-700 z-10">
                        &#8592;
                    </button>
                    <button @click="move(1)" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-green-600 text-white p-4 rounded-full hover:bg-green-700 z-10">
                        &#8594;
                    </button>
                </div>




            </section>

            <!-- Información adicional o pie de página -->
            <footer class="text-center py-8">
                <p class="text-gray-600 dark:text-gray-300">© 2024 Casino Online. Todos los derechos reservados.</p>
            </footer>
        </main>
    </div>

    <script>
        function carousel() {
            return {
                currentIndex: 0,
                slides: 3, // El número total de slides
                rotationInterval: null,
                move(step) {
                    this.currentIndex = (this.currentIndex + step + this.slides) % this.slides;
                },
                startRotation() {
                    this.rotationInterval = setInterval(() => {
                        this.move(1);
                    }, 3000); // Cambia cada 3 segundos
                },
            }
        }
    </script>


</body>

</html>