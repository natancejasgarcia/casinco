<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'money',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // En el modelo User
    public function earnMoney($amount)
    {
        $this->increment('money', $amount); // Incrementa la columna 'money'

        // Registra la transacción
        $this->transactions()->create([
            'type' => 'deposit',
            'amount' => $amount,
        ]);

        $this->save(); // Aunque el increment ya guarda, si modificas algo más, asegúrate de guardar
    }
    public function spendMoney($amount)
    {
        Log::info("Intentando gastar $amount monedas del usuario con ID {$this->id}");
        if ($this->money >= $amount) {
            $this->decrement('money', $amount);
            // El método decrement ya persiste el cambio, por lo que no necesitas llamar a $this->save()

            // Registro de la transacción como gasto
            $this->transactions()->create([
                'type' => 'withdrawal', // Asegúrate de que 'withdraw' es un string
                'amount' => $amount,
                'user_id' => $this->id, // Asegúrate de pasar el id del usuario si es necesario
            ]);
            Log::info("Transacción completada: {$amount} monedas descontadas del usuario: {$this->id}");
            return true;
        }
        Log::info("Error al descontar monedas: saldo insuficiente para el usuario: {$this->id}");
        return false; // No hay suficiente dinero
    }
    // Relación con el modelo Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
