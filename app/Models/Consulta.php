<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consulta extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paciente() : BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}
