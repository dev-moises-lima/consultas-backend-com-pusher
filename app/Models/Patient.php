<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cpf', 'telephone', 'dateOfBirth', 'photo'];

    public function consultations() : HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}