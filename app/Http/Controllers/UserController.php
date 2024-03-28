<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la fachada Auth aquí

class UserController extends Controller
{
    public function ganarMoney(Request $request)
    {
        $user = Auth::user();
        $user->earnMoney(100); // Utiliza el método earnMoney del modelo User

        // Assumiendo que el método earnMoney ya está creando una transacción
        return redirect()->back()->with('success', '¡Has ganado 100 Monedas!');
    }
}
