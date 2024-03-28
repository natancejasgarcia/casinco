<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Juego Adivina el Número
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
    <x-guess-number-game />
</x-app-layout>