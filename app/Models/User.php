<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaction;

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
        if ($this->money >= $amount) {
            $this->decrement('money', $amount); // Decrementa la columna 'money' automáticamente y guarda el cambio

            // Registro de la transacción como gasto
            $this->transactions()->create([
                'type' => 'withdraw',
                'amount' => $amount,
            ]);

            return true;
        }

        return false; // No hay suficiente dinero
    }

    // Relación con el modelo Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
