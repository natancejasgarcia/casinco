<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'amount',
    ];

    /**
     * Indica si los IDs son autoincrementables.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Obtiene el usuario asociado a la transacción.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
