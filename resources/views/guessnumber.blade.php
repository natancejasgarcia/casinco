<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Juego Adivina el Número
            </h2>
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="flex items-center">
                <p class="mr-1 user-money">Tienes {{ Auth::user()->money }}</p>
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

    <div class="text-center mt-8">
        <h2 class="text-2xl font-bold mb-4">Juego de Adivina el Número</h2>

        <div>
            <label for="numberRange" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Selecciona un rango de números:</label>
            <div class="flex justify-center">
                <select id="numberRange" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="10">1 a 10 (Ganancia x3)</option>
                    <option value="25">1 a 25 (Ganancia x10)</option>
                    <option value="50">1 a 50 (Ganancia x20)</option>
                    <option value="75">1 a 75 (Ganancia x50)</option>
                    <option value="100">1 a 100 (Ganancia x100)</option>
                </select>
            </div>
        </div>


        <button id="revealNumberButton" class="mt-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
            Revelar Mi Número
        </button>

        <button id="playButton" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Juega - Gasta 100 monedas
        </button>

        <p id="playerNumber" class="mt-4"></p>
        <p id="gameResult" class="mt-4"></p>
    </div>
    <audio id="coinSound" src="{{ asset('sonidos/sonidodedinero.mp3') }}"></audio>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const revealNumberButton = document.getElementById('revealNumberButton');
            const playButton = document.getElementById('playButton');
            const gameResult = document.getElementById('gameResult');
            const playerNumber = document.getElementById('playerNumber');
            const numberRange = document.getElementById('numberRange');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let selectedNumber = null;

            revealNumberButton.addEventListener('click', () => {
                const range = parseInt(numberRange.value);
                selectedNumber = Math.floor(Math.random() * range) + 1;
                playerNumber.textContent = `Tu número seleccionado: ${selectedNumber}`;
            });

            playButton.addEventListener('click', () => {
                if (!selectedNumber) {
                    gameResult.textContent = "Por favor, revela tu número primero.";
                    return;
                }

                // Asegúrate de reemplazar '/juego/jugar' con la URL correcta de tu ruta
                fetch('/juego/jugar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            numero_elegido: selectedNumber,
                            rango: parseInt(numberRange.value),
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Actualiza el contenido basado en la respuesta del servidor
                        gameResult.textContent = data.message;
                        // Opcionalmente, actualiza el saldo del usuario mostrado en la página
                        if (data.userMoney !== undefined) {
                            document.querySelector('.user-money').textContent = `Tienes ${data.userMoney}`;
                        }
                        // Si el jugador gana, reproduce el sonido de monedas
                        if (data.win) {
                            var coinSound = document.getElementById("coinSound");
                            coinSound.play();
                        }

                    })
                    .catch(error => {
                        console.error('Error:', error);
                        gameResult.textContent = "Hubo un error procesando tu solicitud.";
                    });
            });
        });
    </script>
</x-app-layout>