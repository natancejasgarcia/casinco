<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        // Descontamos las 100 monedas por jugar aquí.
        $user->spendMoney(100);

        $numeroElegido = $request->numero_elegido;
        $rango = $request->rango;
        $numeroMaquina = mt_rand(1, $rango);
        $multiplier = $this->determinarMultiplicador($rango);

        if ($numeroElegido === $numeroMaquina) {
            // Calcula las ganancias basadas en el multiplicador
            $ganancias = 100 * $multiplier;
            $user->earnMoney($ganancias); // Asume que este método ya registra la transacción correspondiente.

            return response()->json([
                'success' => true,
                'message' => "¡Has ganado! Tus ganancias son: $ganancias monedas.",
                'userMoney' => $user->money,
                'machineNumber' => $numeroMaquina,
                'win' => true,
            ]);
        } else {
            // Si no hay victoria, solo se devuelve el mensaje correspondiente.
            $user->money -= 100; // Asegúrate de descontar las monedas por jugar si no se hizo anteriormente
            $user->save();

            return response()->json([
                'success' => false,
                'message' => "Lo siento, no has ganado. El número de la máquina era: $numeroMaquina.",
                'userMoney' => $user->money,
                'machineNumber' => $numeroMaquina,
                'win' => false,
            ]);
        }
    }

    private function determinarMultiplicador($rango)
    {
        switch ($rango) {
            case 10:
                return 3;
            case 25:
                return 10;
            case 50:
                return 20;
            case 75:
                return 50;
            case 100:
                return 100;
            default:
                // Considera lanzar una excepción o manejar este caso de forma adecuada
                return 0;
        }
    }
}
