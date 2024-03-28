<div class="text-center mt-8">
    <h2 class="text-2xl font-bold mb-4">Juego de Adivina el Número</h2>

    <div>
        <label for="numberRange" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Selecciona un rango de números:</label>
        <select id="numberRange" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="10">1 a 10 (Ganancia x1.5)</option>
            <option value="25">1 a 25 (Ganancia x4)</option>
            <option value="50">1 a 50 (Ganancia x8)</option>
            <option value="75">1 a 75 (Ganancia x16)</option>
            <option value="100">1 a 100 (Ganancia x32)</option>
        </select>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const revealNumberButton = document.getElementById('revealNumberButton');
        const playButton = document.getElementById('playButton');
        const gameResult = document.getElementById('gameResult');
        const playerNumber = document.getElementById('playerNumber');
        const numberRange = document.getElementById('numberRange');

        let selectedNumber = null;

        revealNumberButton.addEventListener('click', () => {
            const range = parseInt(numberRange.value);
            selectedNumber = Math.floor(Math.random() * range) + 1; // Número aleatorio dentro del rango seleccionado
            playerNumber.textContent = `Tu número seleccionado: ${selectedNumber}`;
        });

        playButton.addEventListener('click', () => {
            if (!selectedNumber) {
                gameResult.textContent = "Por favor, revela tu número primero.";
                return;
            }

            const range = parseInt(numberRange.value);
            const machineNumber = Math.floor(Math.random() * range) + 1; // Número seleccionado por la máquina

            // Determina el multiplicador según el rango
            let multiplier = range === 10 ? 1.5 : range === 25 ? 4 : range === 50 ? 8 : range === 75 ? 16 : 32;

            // Simula una "victoria" para demostración. En un juego real, necesitarías una lógica de victoria definida.
            const win = selectedNumber === machineNumber;

            const winnings = win ? 100 * multiplier : 0;

            gameResult.textContent = win ? `¡Has ganado! Número de la máquina: ${machineNumber}. Tus ganancias son: ${winnings} monedas.` : `Lo siento, no has ganado. Número de la máquina: ${machineNumber}.`;
            selectedNumber = null; // Resetea el número seleccionado para el próximo juego
        });
    });
</script>