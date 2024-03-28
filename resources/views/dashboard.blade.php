<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center">
                <p class="mr-1">Tienes {{ Auth::user()->money }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            @if(session('success'))
            <div id="alerta" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-2 px-4 rounded-md flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('alerta').style.display='none'" class="text-white ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById('alerta').style.display = 'none';
                }, 4000); // Oculta el mensaje después de 4 segundos
            </script>
            @endif



            <form action="{{ route('ganar.money') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-lg">
                    Gana 100 monedas
                </button>
            </form>

        </div>
    </x-slot>

    <div class="flex flex-col lg:flex-row gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        <div class="flex-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>

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

        <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow p-4 ml-auto">
            <h3 class="text-lg font-semibold mb-2 text-center">Transacciones Recientes</h3>
            @if(Auth::user()->transactions->isNotEmpty())
            <div class="space-y-2">
                @php
                $transactions = Auth::user()->transactions->take(-5)->reverse();
                @endphp
                @foreach($transactions as $transaction)
                <div class="transaccion flex justify-between items-center">
                    <span>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</span>
                    <span>{{ $transaction->type }}</span>
                    <span>{{ $transaction->amount }} monedas</span>

                </div>
                @endforeach
                <p class="text-center">......</p>

            </div>
            @else
            <p class="text-right">No hay transacciones recientes.</p>
            @endif
        </div>


    </div>

    <section class="mb-8 m-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center dark:text-white mb-6">Juegos Destacados</h2>
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
                <a href="{{ route('guessnumber') }}" class="play-link w-full block bg-green-500 text-white text-center py-2 hover:bg-green-700 transition-colors duration-300" data-text="Juega ahora">Jugar</a>
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