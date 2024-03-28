<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JuegoController extends Controller
{
    public function mostrarVistaJuego()
    {
        return view('guessnumber');
    }

    public function jugar(Request $request)
    {
        $request->validate([
            'numero_elegido' => 'required|integer|min:1',
            'rango' => 'required|integer|in:10,25,50,75,100',
        ]);

        $user = Auth::user();
        if ($user->money < 100) {
            return response()->json([
                'success' => false,
                'message' => "No tienes suficientes monedas para jugar.",
                'userMoney' => $user->money,
            ]);
        }

        $numeroElegido = $request->numero_elegido;
        $rango = $request->rango;
        $numeroMaquina = mt_rand(1, $rango);
        $multiplier = $this->determinarMultiplicador($rango);

        // Aquí, simplemente descontamos las 100 monedas por jugar.
        $user->spendMoney(100);

        if ($numeroElegido === $numeroMaquina) {
            // Calcula las ganancias basadas en el multiplicador
            $ganancias = 100 * $multiplier;
            $user->earnMoney($ganancias); // Asume que este método ya registra la transacción correspondiente.

            return response()->json([
                'success' => true,
                'message' => "¡Has ganado! Tus ganancias son: $ganancias monedas.",
                'userMoney' => $user->money,
            ]);
        } else {
            // Si no hay victoria, solo se devuelve el mensaje correspondiente.
            return response()->json([
                'success' => false,
                'message' => "Lo siento, no has ganado. El número de la máquina era: $numeroMaquina.",
                'userMoney' => $user->money,
            ]);
        }
    }

    private function determinarMultiplicador($rango)
    {
        switch ($rango) {
            case 10:
                return 1.5;
            case 25:
                return 4;
            case 50:
                return 8;
            case 75:
                return 16;
            case 100:
                return 32;
            default:
                // Considera lanzar una excepción o manejar este caso de forma adecuada
                return 0;
        }
    }
}
